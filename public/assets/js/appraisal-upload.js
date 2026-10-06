(function () {
    const form = document.getElementById('appraisalUploadForm');
    if (!form) return;

    const feedback = document.getElementById('appraisalUploadFeedback');
    const photoInput = document.getElementById('assetPhotos');
    const reportInput = document.getElementById('appraisalReportPdf');
    const locationMetadata = document.getElementById('photoLocationMetadata');
    const metadataDisplay = document.getElementById('captureMetadata');
    const latitudeInput = document.getElementById('photoLatitude');
    const longitudeInput = document.getElementById('photoLongitude');
    const fileInputs = form.querySelectorAll('input[type="file"]');
    const accumulatedAssetPhotos = new Map();
    const photoObjectUrls = new Map();
    const supportingObjectUrls = new Map();
    let reportObjectUrls = [];
    const photoPreview = document.getElementById('assetPhotoPreview');
    const photoPreviewImage = document.getElementById('assetPhotoPreviewImage');
    const photoPreviewTitle = document.getElementById('assetPhotoPreviewTitle');
    let previouslyFocusedElement = null;
    let reviewDbPromise = null;
    let reviewStorageError = null;
    let fileWriteQueue = Promise.resolve();

    const excelExtensions = ['xls', 'xlsx', 'xlsm', 'xlsb', 'xlt', 'xltx', 'xltm', 'xml', 'csv', 'ods'];
    const wordExtensions = ['doc', 'docx', 'docm', 'dot', 'dotx', 'dotm', 'odt', 'rtf'];
    const reviewCategoryByInput = {
        collateralLegalDocs: 'legalDocuments',
        bpnCheckDocs: 'bpnDocuments',
        otherSupportingDocs: 'otherDocuments'
    };
    function extensionOf(file) {
        return file.name.split('.').pop().toLowerCase();
    }

    function makeFileLink(file, url, autoDownload) {
        const link = document.createElement('a');
        link.className = 'new-app-btn new-app-btn--secondary';
        link.href = url;
        link.target = '_blank';
        link.rel = 'noopener';
        link.textContent = (autoDownload ? 'Download ' : 'Open ') + file.name;
        if (autoDownload) link.download = file.name;
        return link;
    }

    function openPhotoPreview(file, url, trigger) {
        previouslyFocusedElement = trigger;
        photoPreviewTitle.textContent = file.name;
        photoPreviewImage.src = url;
        photoPreview.hidden = false;
        photoPreview.setAttribute('aria-hidden', 'false');
        document.body.classList.add('review-action-modal-open');
        photoPreview.querySelector('.review-action-modal__dialog [data-photo-preview-close]').focus();
    }

    function isImageFile(file) {
        return file.type.startsWith('image/') || ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'].includes(extensionOf(file));
    }

    let coordinateTimestamp = '';
    function updateCoordinateMetadata() {
        const latitudeText = latitudeInput.value.trim();
        const longitudeText = longitudeInput.value.trim();
        const latitude = Number(latitudeText);
        const longitude = Number(longitudeText);
        const latitudeValid = latitudeText !== '' && Number.isFinite(latitude) && latitude >= -90 && latitude <= 90;
        const longitudeValid = longitudeText !== '' && Number.isFinite(longitude) && longitude >= -180 && longitude <= 180;
        latitudeInput.setCustomValidity(latitudeValid ? '' : 'Enter a latitude between -90 and 90.');
        longitudeInput.setCustomValidity(longitudeValid ? '' : 'Enter a longitude between -180 and 180.');

        if (!latitudeValid || !longitudeValid) {
            locationMetadata.value = '';
            metadataDisplay.textContent = latitudeText || longitudeText
                ? 'Enter valid latitude and longitude coordinates.'
                : 'Enter coordinates or use device location';
            return false;
        }
        if (!coordinateTimestamp) coordinateTimestamp = new Date().toLocaleString();
        locationMetadata.value = latitudeText + ', ' + longitudeText + ' - ' + coordinateTimestamp;
        metadataDisplay.textContent = locationMetadata.value;
        return true;
    }
    latitudeInput.addEventListener('input', updateCoordinateMetadata);
    longitudeInput.addEventListener('input', updateCoordinateMetadata);

    // Populate required coordinates from browser geolocation when available.
    document.addEventListener('click', function (event) {
        const trigger = event.target.closest('#capturePhotoMetadata');
        if (!trigger) return;
        event.preventDefault();
        event.stopImmediatePropagation();
        if (!navigator.geolocation) {
            metadataDisplay.textContent = 'Device location is unavailable. Enter the coordinates manually.';
            return;
        }
        metadataDisplay.textContent = 'Requesting device location...';
        navigator.geolocation.getCurrentPosition(function (position) {
            latitudeInput.value = position.coords.latitude.toFixed(6);
            longitudeInput.value = position.coords.longitude.toFixed(6);
            coordinateTimestamp = new Date().toLocaleString();
            updateCoordinateMetadata();
        }, function () {
            metadataDisplay.textContent = 'Location permission unavailable. Enter the coordinates manually.';
        }, { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 });
    }, true);

    function openReviewDatabase() {
        if (reviewDbPromise) return reviewDbPromise;
        reviewDbPromise = new Promise(function (resolve, reject) {
            if (!window.indexedDB) { reject(new Error('This browser cannot keep selected files for the review page.')); return; }
            const request = indexedDB.open('aggreAppraisalReviewFrontend', 1);
            request.onupgradeneeded = function () {
                if (!request.result.objectStoreNames.contains('files')) request.result.createObjectStore('files', { keyPath: 'id' });
            };
            request.onsuccess = function () { resolve(request.result); };
            request.onerror = function () { reject(request.error || new Error('Unable to open temporary file storage.')); };
        });
        return reviewDbPromise;
    }

    function queueFileCategory(category, files) {
        const operation = fileWriteQueue.then(function () {
            if (reviewStorageError) throw reviewStorageError;
            return openReviewDatabase().then(function (database) {
                return new Promise(function (resolve, reject) {
                    const transaction = database.transaction('files', 'readwrite');
                    const store = transaction.objectStore('files');
                    const read = store.getAll();
                    read.onsuccess = function () {
                        read.result.filter(function (entry) { return entry.category === category; }).forEach(function (entry) {
                            store.delete(entry.id);
                        });
                        files.forEach(function (file, index) {
                            store.put({ id: category + ':' + index, category: category, name: file.name, type: file.type, blob: file });
                        });
                    };
                    transaction.oncomplete = resolve;
                    transaction.onerror = function () { reject(transaction.error || new Error('Unable to save files for review.')); };
                    transaction.onabort = function () { reject(transaction.error || new Error('Saving files for review was cancelled.')); };
                });
            });
        });
        fileWriteQueue = operation.catch(function (error) { reviewStorageError = error; });
        return fileWriteQueue;
    }

    function resetReviewFiles() {
        fileWriteQueue = openReviewDatabase().then(function (database) {
            return new Promise(function (resolve, reject) {
                const transaction = database.transaction('files', 'readwrite');
                transaction.objectStore('files').clear();
                transaction.oncomplete = resolve;
                transaction.onerror = function () { reject(transaction.error || new Error('Unable to reset temporary review files.')); };
                transaction.onabort = function () { reject(transaction.error || new Error('Resetting temporary review files was cancelled.')); };
            });
        }).catch(function (error) { reviewStorageError = error; });
    }

    resetReviewFiles();

    // Validate in the submit handler so the browser cannot block submission
    // before we can account for photos selected in separate batches.
    form.noValidate = true;

    fileInputs.forEach(function (input) {
        input.addEventListener('change', function () {
            const summary = document.querySelector('[data-file-summary="' + input.id + '"]');
            const files = Array.from(input.files);
            if (summary) {
                summary.textContent = files.length
                    ? files.length + (input.multiple ? ' file(s) selected' : ' file selected') + ': ' + files.map(function (file) { return file.name; }).join(', ')
                    : (input.multiple ? 'No files selected' : 'No file selected');
            }

            const previewList = document.querySelector('[data-file-preview-list="' + input.id + '"]');
            if (!previewList || input === photoInput || input === reportInput) return;
            (supportingObjectUrls.get(input.id) || []).forEach(function (url) { URL.revokeObjectURL(url); });
            supportingObjectUrls.set(input.id, []);
            previewList.replaceChildren();

            files.forEach(function (file) {
                const url = URL.createObjectURL(file);
                supportingObjectUrls.get(input.id).push(url);
                const ext = extensionOf(file);
                if (isImageFile(file)) {
                    const button = document.createElement('button');
                    button.type = 'button';
                    button.className = 'new-app-btn new-app-btn--secondary';
                    button.textContent = 'Preview ' + file.name;
                    button.addEventListener('click', function () { openPhotoPreview(file, url, button); });
                    previewList.appendChild(button);
                } else {
                    const isPdf = ext === 'pdf';
                    previewList.appendChild(makeFileLink(file, url, !isPdf));
                }
            });
            queueFileCategory(reviewCategoryByInput[input.id] || input.id, files);
        });
    });

    photoInput.addEventListener('change', function () {
        Array.from(photoInput.files).forEach(function (file) {
            accumulatedAssetPhotos.set([file.name, file.size, file.lastModified].join(':'), file);
        });

        // Keep the accumulated selection in the native input when supported,
        // so the visible file list and submitted FormData stay in sync.
        if (window.DataTransfer) {
            try {
                const transfer = new DataTransfer();
                accumulatedAssetPhotos.forEach(function (file) { transfer.items.add(file); });
                photoInput.files = transfer.files;
            } catch (error) {
                // The separate map still provides the correct count on browsers
                // that do not allow assigning to input.files.
            }
        }

        const count = Math.max(accumulatedAssetPhotos.size, photoInput.files.length);
        photoInput.setCustomValidity(count < 5 ? 'Select at least five asset photos.' : '');
        const summary = document.querySelector('[data-file-summary="assetPhotos"]');
        const previewList = document.querySelector('[data-file-preview-list="assetPhotos"]');
        if (summary) {
            const files = Array.from(accumulatedAssetPhotos.values());
            summary.textContent = files.length
                ? files.length + ' file(s) selected: ' + files.map(function (file) { return file.name; }).join(', ')
                : 'No files selected';
        }
        if (previewList) {
            previewList.replaceChildren();
            accumulatedAssetPhotos.forEach(function (file, key) {
                if (!photoObjectUrls.has(key)) photoObjectUrls.set(key, URL.createObjectURL(file));
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'new-app-btn new-app-btn--secondary';
                button.dataset.photoKey = key;
                button.textContent = 'Preview ' + file.name;
                button.addEventListener('click', function () {
                    openPhotoPreview(file, photoObjectUrls.get(key), button);
                });
                previewList.appendChild(button);
            });
        }
        queueFileCategory('assetPhotos', Array.from(accumulatedAssetPhotos.values()));
    });

    reportInput.addEventListener('change', function () {
        reportObjectUrls.forEach(function (url) { URL.revokeObjectURL(url); });
        reportObjectUrls = [];
        const files = Array.from(reportInput.files);
        const summary = document.querySelector('[data-file-summary="appraisalReportPdf"]');
        const previewList = document.querySelector('[data-file-preview-list="appraisalReportPdf"]');
        summary.textContent = files.length
            ? files.length + ' report file(s) selected: ' + files.map(function (file) { return file.name; }).join(', ')
            : 'No files selected';
        previewList.replaceChildren();

        files.forEach(function (file) {
            const ext = extensionOf(file);
            const isPdf = ext === 'pdf';
            const isSpreadsheet = excelExtensions.includes(ext);
            const isDocument = wordExtensions.includes(ext);
            if (!isPdf && !isSpreadsheet && !isDocument) return;
            const url = URL.createObjectURL(file);
            reportObjectUrls.push(url);
            previewList.appendChild(makeFileLink(file, url, !isPdf));
        });

        const supported = files.every(function (file) {
            const ext = extensionOf(file);
            return ext === 'pdf' || excelExtensions.includes(ext) || wordExtensions.includes(ext);
        });
        reportInput.setCustomValidity(!files.length
            ? 'Upload at least one appraisal report file.'
            : (!supported ? 'Use PDF, Excel, or Word document files.' : ''));
        queueFileCategory('appraisalReport', files);
    });

    function closePhotoPreview() {
        photoPreview.hidden = true;
        photoPreview.setAttribute('aria-hidden', 'true');
        photoPreviewImage.removeAttribute('src');
        document.body.classList.remove('review-action-modal-open');
        if (previouslyFocusedElement) previouslyFocusedElement.focus();
    }
    photoPreview.querySelectorAll('[data-photo-preview-close]').forEach(function (button) {
        button.addEventListener('click', closePhotoPreview);
    });
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !photoPreview.hidden) closePhotoPreview();
    });

    document.getElementById('saveAppraisalUploads').addEventListener('click', function () {
        feedback.textContent = 'Upload draft captured in this prototype. The selected files have not been uploaded or saved.';
        feedback.hidden = false;
    });

    form.addEventListener('submit', async function (event) {
        event.preventDefault();
        if (!updateCoordinateMetadata()) {
            if (latitudeInput.validationMessage) latitudeInput.reportValidity();
            else longitudeInput.reportValidity();
            return;
        }
        const photoCount = Math.max(accumulatedAssetPhotos.size, photoInput.files.length);
        photoInput.setCustomValidity(photoCount < 5 ? 'Select at least five asset photos.' : '');
        const reports = Array.from(reportInput.files);
        const supportedReports = reports.every(function (file) {
            const ext = extensionOf(file);
            return ext === 'pdf' || excelExtensions.includes(ext) || wordExtensions.includes(ext);
        });
        reportInput.setCustomValidity(!reports.length
            ? 'Upload at least one appraisal report file.'
            : (!supportedReports ? 'Use PDF, Excel, or Word document files.' : ''));
        const legalDocsInput = document.getElementById('collateralLegalDocs');
        legalDocsInput.setCustomValidity(legalDocsInput.files.length ? '' : 'Upload the collateral legal documents.');

        if (photoCount < 5) { photoInput.reportValidity(); return; }
        if (!supportedReports || !reports.length) { reportInput.reportValidity(); return; }
        if (!legalDocsInput.files.length) { legalDocsInput.reportValidity(); return; }

        const continueButton = document.getElementById('continueToFinalSubmission');
        continueButton.disabled = true;
        continueButton.textContent = 'Opening Review...';
        try {
            sessionStorage.setItem('appraisalReview:uploads', JSON.stringify({
                assetPhotos: Array.from(accumulatedAssetPhotos.values()).map(function (file) { return file.name; }).length
                    ? Array.from(accumulatedAssetPhotos.values()).map(function (file) { return file.name; })
                    : Array.from(photoInput.files).map(function (file) { return file.name; }),
                appraisalReport: reports.map(function (file) { return file.name; }),
                legalDocuments: Array.from(legalDocsInput.files).map(function (file) { return file.name; }),
                bpnDocuments: Array.from(document.getElementById('bpnCheckDocs').files).map(function (file) { return file.name; }),
                otherDocuments: Array.from(document.getElementById('otherSupportingDocs').files).map(function (file) { return file.name; }),
                photoMetadata: locationMetadata.value
            }));
            await fileWriteQueue;
            if (reviewStorageError) throw reviewStorageError;
        } catch (error) {
            feedback.textContent = error.message || 'Unable to prepare selected files for review. Please try again.';
            feedback.hidden = false;
            continueButton.disabled = false;
            continueButton.textContent = 'Continue to Final Submission';
            return;
        }
        window.location.href = form.dataset.reviewUrl + window.location.search;
    });
})();
