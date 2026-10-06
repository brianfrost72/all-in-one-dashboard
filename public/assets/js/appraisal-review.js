(function () {
    const feedback = document.getElementById('appraisalReviewFeedback');
    const photoModal = document.getElementById('reviewAssetPhotoPreview');
    const photoImage = document.getElementById('reviewAssetPhotoImage');
    const photoTitle = document.getElementById('reviewAssetPhotoTitle');
    let activePreviewTrigger = null;

    function read(key) {
        try { return JSON.parse(sessionStorage.getItem('appraisalReview:' + key) || '{}'); }
        catch (error) { return {}; }
    }

    function display(key, value) {
        const target = document.querySelector('[data-review="' + key + '"]');
        if (target) target.textContent = value || '—';
    }

    function extensionOf(file) { return file.name.split('.').pop().toLowerCase(); }
    function mimeFor(file) {
        const mime = file.type || file.blob.type;
        if (mime) return mime;
        return extensionOf(file) === 'pdf' ? 'application/pdf' : '';
    }
    function isImage(file) {
        return file.type.startsWith('image/') || ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'].includes(extensionOf(file));
    }
    function openPhoto(file, url, trigger) {
        activePreviewTrigger = trigger;
        photoTitle.textContent = file.name;
        photoImage.src = url;
        photoModal.hidden = false;
        photoModal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('review-action-modal-open');
        photoModal.querySelector('.review-action-modal__dialog [data-review-photo-close]').focus();
    }
    function closePhoto() {
        photoModal.hidden = true;
        photoModal.setAttribute('aria-hidden', 'true');
        photoImage.removeAttribute('src');
        document.body.classList.remove('review-action-modal-open');
        if (activePreviewTrigger) activePreviewTrigger.focus();
    }
    function addFileAction(container, record) {
        const file = new File([record.blob], record.name, { type: mimeFor(record) });
        const url = URL.createObjectURL(file);
        const ext = extensionOf(file);
        if (isImage(file)) {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'new-app-btn new-app-btn--secondary';
            button.textContent = 'Preview ' + file.name;
            button.addEventListener('click', function () { openPhoto(file, url, button); });
            container.appendChild(button);
            return;
        }
        const link = document.createElement('a');
        link.className = 'new-app-btn new-app-btn--secondary';
        link.href = url;
        link.target = '_blank';
        link.rel = 'noopener';
        link.textContent = ext === 'pdf' ? 'Open ' + file.name : 'Download ' + file.name;
        if (ext !== 'pdf') link.download = file.name;
        container.appendChild(link);
    }

    function loadReviewFiles() {
        return new Promise(function (resolve, reject) {
            if (!window.indexedDB) { reject(new Error('Temporary file storage is unavailable.')); return; }
            const request = indexedDB.open('aggreAppraisalReviewFrontend', 1);
            request.onerror = function () { reject(request.error || new Error('Unable to open the review files.')); };
            request.onsuccess = function () {
                const database = request.result;
                if (!database.objectStoreNames.contains('files')) { database.close(); resolve([]); return; }
                const readRequest = database.transaction('files', 'readonly').objectStore('files').getAll();
                readRequest.onsuccess = function () { const files = readRequest.result; database.close(); resolve(files); };
                readRequest.onerror = function () { database.close(); reject(readRequest.error || new Error('Unable to read the review files.')); };
            };
        });
    }

    const visit = read('siteVisit');
    const summary = read('assetSummary');
    const uploads = read('uploads');
    ['appraiserType', 'appraiser', 'scheduledAt', 'contactName', 'contactPhone', 'visitOutcome'].forEach(function (key) {
        display(key, visit[key]);
    });
    ['reportNumber', 'surveyDate', 'reportDate', 'valuationPurpose', 'finalBasis', 'liquidationPercent', 'marketValue', 'liquidationValue', 'correctionNote'].forEach(function (key) {
        display(key, summary[key]);
    });
    ['assetPhotos', 'appraisalReport', 'legalDocuments', 'bpnDocuments', 'otherDocuments'].forEach(function (key) {
        const files = uploads[key];
        const count = Array.isArray(files) ? files.length : 0;
        display(key, count ? count + (count === 1 ? ' file attached' : ' files attached') : 'No files attached');
    });
    display('photoMetadata', uploads.photoMetadata);

    loadReviewFiles().then(function (files) {
        const renderedCategories = new Set();
        files.forEach(function (record) {
            const categoryAliases = {
                collateralLegalDocs: 'legalDocuments',
                bpnCheckDocs: 'bpnDocuments',
                otherSupportingDocs: 'otherDocuments'
            };
            const category = categoryAliases[record.category] || record.category;
            const container = document.querySelector('[data-review-file-actions="' + category + '"]');
            if (container) {
                addFileAction(container, record);
                renderedCategories.add(category);
            }
        });
        ['assetPhotos', 'appraisalReport', 'legalDocuments', 'bpnDocuments', 'otherDocuments'].forEach(function (category) {
            const container = document.querySelector('[data-review-file-actions="' + category + '"]');
            const names = uploads[category];
            if (container && !renderedCategories.has(category) && Array.isArray(names) && names.length) {
                container.textContent = 'File data is not available in this review session. Return to Upload Appraisal Results, select the files again, then continue.';
            }
        });
    }).catch(function () {
        document.querySelectorAll('[data-review-file-actions]').forEach(function (container) {
            container.textContent = 'File preview is unavailable in this browser session.';
        });
    });

    photoModal.querySelectorAll('[data-review-photo-close]').forEach(function (button) {
        button.addEventListener('click', closePhoto);
    });
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !photoModal.hidden) closePhoto();
    });

    document.getElementById('submitReviewedAppraisal').addEventListener('click', function () {
        const finalStep = document.querySelector('[data-review-final-step]');
        finalStep.classList.remove('is-active');
        finalStep.classList.add('is-completed');
        finalStep.removeAttribute('aria-current');
        finalStep.querySelector('.new-app-progress-step__number').innerHTML = '<i class="fa-solid fa-check" aria-hidden="true"></i>';
        feedback.textContent = 'Appraisal results submitted in this prototype. No files or appraisal data were sent to the server.';
        feedback.hidden = false;
        this.textContent = 'Submission Complete';
        this.disabled = true;
    });
})();
