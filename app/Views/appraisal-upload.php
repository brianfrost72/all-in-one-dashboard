<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Appraisal Results &ndash; Aggre Capital Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/sidebar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/anim.css') ?>">
</head>

<body>
    <?= $this->include('layouts/sidebar') ?>
    <main class="main-section appraisal-workspace">
        <header class="appraisal-workspace__header">
            <nav class="appraisal-workspace__breadcrumb" aria-label="Breadcrumb">
                <a href="<?= base_url('appraisal-list') ?>">Collateral Appraisal</a><span>/</span>
                <a href="<?= base_url('asset-appraisal-summary') ?>">Asset Appraisal Summary</a><span>/</span>
                <span>Upload Appraisal Results</span>
            </nav>
            <a class="appraisal-workspace__back" href="<?= base_url('asset-appraisal-summary') ?>"><i
                    class="fa-solid fa-arrow-left" aria-hidden="true"></i> Back to asset summary</a>
        </header>
        <div class="appraisal-workspace__content">
            <section class="appraisal-task-heading">
                <div>
                    <span class="appraisal-task-heading__eyebrow">Appraisal Deliverables</span>
                    <h1>Upload Appraisal Results</h1>
                    <p><?= esc(($applicationNo ?? null) ?: 'Appraisal Task') ?> &bull;
                        <?= esc(($borrower ?? null) ?: 'Borrower') ?> &bull;
                        <?= esc(($collateral ?? null) ?: 'Collateral') ?>
                    </p>
                </div>
                <span class="appraisal-task-heading__status"><i class="fa-solid fa-circle" aria-hidden="true"></i>Asset
                    Summary Completed</span>
            </section>

            <section class="new-app-progress-card appraisal-process-progress" aria-label="Appraisal process progress">
                <div class="new-app-progress-scroll">
                    <nav class="new-app-progress-track" aria-label="Appraisal steps">
                        <span class="new-app-progress-step is-completed" data-appraisal-step="1"><span
                                class="new-app-progress-step__number"><i class="fa-solid fa-check"
                                    aria-hidden="true"></i></span><span class="new-app-progress-step__label">Task
                                Assignment</span></span>
                        <span class="new-app-progress-line is-completed" aria-hidden="true"></span>
                        <span class="new-app-progress-step is-completed" data-appraisal-step="2"><span
                                class="new-app-progress-step__number"><i class="fa-solid fa-check"
                                    aria-hidden="true"></i></span><span class="new-app-progress-step__label">Scheduling
                                &amp; Site Visit</span></span>
                        <span class="new-app-progress-line is-completed" aria-hidden="true"></span>
                        <span class="new-app-progress-step is-completed" data-appraisal-step="3"><span
                                class="new-app-progress-step__number"><i class="fa-solid fa-check"
                                    aria-hidden="true"></i></span><span class="new-app-progress-step__label">Asset
                                Appraisal Summary</span></span>
                        <span class="new-app-progress-line is-completed" aria-hidden="true"></span>
                        <span class="new-app-progress-step is-active" data-appraisal-step="4" aria-current="step"><span
                                class="new-app-progress-step__number">4</span><span
                                class="new-app-progress-step__label">Upload Appraisal Results</span></span>
                        <span class="new-app-progress-line" aria-hidden="true"></span>
                        <span class="new-app-progress-step" data-appraisal-step="5"><span
                                class="new-app-progress-step__number">5</span><span
                                class="new-app-progress-step__label">Submit Appraisal Results</span></span>
                    </nav>
                </div>
            </section>

            <form id="appraisalUploadForm" class="new-app-application-stack" data-review-url="<?= base_url('appraisal-review') ?>">
                <section class="new-app-form-card">
                    <h2 class="new-app-form-card__title">Photo Location and Time</h2>
                    <p>Enter the property's map coordinates manually or use your device location. Coordinates are required before continuing.</p>
                    <div class="application-parameters-grid">
                        <div class="new-app-field">
                            <label class="new-app-field__label" for="photoLatitude">Latitude <span>*</span></label>
                            <input class="new-app-control" id="photoLatitude" name="photo_latitude" type="number" min="-90" max="90" step="any" inputmode="decimal" placeholder="For example, -6.200000" required>
                        </div>
                        <div class="new-app-field">
                            <label class="new-app-field__label" for="photoLongitude">Longitude <span>*</span></label>
                            <input class="new-app-control" id="photoLongitude" name="photo_longitude" type="number" min="-180" max="180" step="any" inputmode="decimal" placeholder="For example, 106.816666" required>
                        </div>
                    </div>
                    <div class="new-app-field new-app-field--full">
                        <label class="new-app-field__label" for="captureMetadata">Coordinates and capture time</label>
                        <div class="new-app-control new-app-control--readonly" id="captureMetadata" aria-live="polite">
                            Enter coordinates or use device location</div>
                        <input id="photoLocationMetadata" name="photo_location_metadata" type="hidden">
                    </div>
                    <div class="new-app-page-actions">
                        <span class="new-app-page-actions__info">Latitude must be between −90 and 90; longitude between −180 and 180.</span>
                        <div class="new-app-page-actions__buttons"><button type="button"
                                class="new-app-btn new-app-btn--secondary" id="capturePhotoMetadata">Use Current Location</button></div>
                    </div>
                </section>

                <section class="new-app-form-card">
                    <h2 class="new-app-form-card__title">Required Appraisal Documents</h2>
                    <p>Upload the files for this collateral. Required files must be attached before you submit the
                        appraisal results.</p>
                    <div class="table-wrap">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Document</th>
                                    <th>Required</th>
                                    <th>Multiple Files</th>
                                    <th>Format / Guidance</th>
                                    <th>Upload</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Asset Photos (front, side, interior, road access, and surroundings)</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Select at least 5 photos. You can add them in multiple selections. Mobile photos
                                        may include location and capture time.</td>
                                    <td><input class="new-app-control" id="assetPhotos" name="asset_photos[]"
                                            type="file" accept="image/*" multiple required
                                            aria-label="Upload at least five asset photos"><small
                                            data-file-summary="assetPhotos" aria-live="polite">No files selected</small>
                                        <div data-file-preview-list="assetPhotos" aria-live="polite"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Full Appraisal Report</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>PDF opens in a new tab. Excel and Word files download when opened.</td>
                                    <td><input class="new-app-control" id="appraisalReportPdf"
                                            name="appraisal_report_files[]" type="file"
                                            accept=".pdf,.xls,.xlsx,.xlsm,.xlsb,.xlt,.xltx,.xltm,.xml,.csv,.ods,.doc,.docx,.docm,.dot,.dotx,.dotm,.odt,.rtf"
                                            multiple required aria-label="Upload appraisal reports as PDF, Excel, or Word files"><small
                                            data-file-summary="appraisalReportPdf" aria-live="polite">No files selected</small>
                                        <div data-file-preview-list="appraisalReportPdf" aria-live="polite"></div></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Reviewed Collateral Legal Documents (SHM, IMB, PBB)</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Images open in the preview modal. PDFs open in a new tab.</td>
                                    <td><input class="new-app-control" id="collateralLegalDocs"
                                            name="collateral_legal_docs[]" type="file" accept=".pdf,.jpg,.jpeg,.png"
                                            multiple required
                                            aria-label="Upload reviewed collateral legal documents"><small
                                            data-file-summary="collateralLegalDocs" aria-live="polite">No files selected</small>
                                        <div data-file-preview-list="collateralLegalDocs" aria-live="polite"></div></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Certificate Check from BPN</td>
                                    <td>No</td>
                                    <td>Yes</td>
                                    <td>Images open in the preview modal. PDFs open in a new tab.</td>
                                    <td><input class="new-app-control" id="bpnCheckDocs" name="bpn_check_docs[]"
                                            type="file" accept=".pdf,.jpg,.jpeg,.png" multiple
                                            aria-label="Upload BPN certificate check documents"><small
                                            data-file-summary="bpnCheckDocs" aria-live="polite">No files selected</small>
                                        <div data-file-preview-list="bpnCheckDocs" aria-live="polite"></div></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Other Supporting Documents (comparables)</td>
                                    <td>No</td>
                                    <td>Yes</td>
                                    <td>Images open in the preview modal. PDF opens in a new tab; Excel and Word download.</td>
                                    <td><input class="new-app-control" id="otherSupportingDocs"
                                            name="other_supporting_docs[]" type="file"
                                            accept=".pdf,.jpg,.jpeg,.png,.xls,.xlsx,.xlsm,.xlsb,.xlt,.xltx,.xltm,.xml,.csv,.ods,.doc,.docx,.docm,.dot,.dotx,.dotm,.odt,.rtf"
                                            multiple aria-label="Upload other supporting documents"><small
                                            data-file-summary="otherSupportingDocs" aria-live="polite">No files selected</small>
                                        <div data-file-preview-list="otherSupportingDocs" aria-live="polite"></div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <footer class="new-app-page-actions">
                        <span class="new-app-page-actions__info">Required: 5 asset photos, a PDF appraisal report, and
                            collateral legal documents.</span>
                        <div class="new-app-page-actions__buttons">
                            <button type="button" class="new-app-btn new-app-btn--secondary"
                                id="saveAppraisalUploads">Save Draft</button>
                            <button type="submit" class="new-app-btn new-app-btn--primary"
                                id="continueToFinalSubmission">Continue to Final Submission</button>
                        </div>
                    </footer>
                </section>

                <p class="appraisal-task-feedback" id="appraisalUploadFeedback" role="status" hidden></p>
            </form>
            <div class="review-action-modal" id="assetPhotoPreview" aria-hidden="true" hidden>
                <button type="button" class="review-action-modal__backdrop" data-photo-preview-close aria-label="Close photo preview"></button>
                <section class="review-action-modal__dialog review-action-modal__dialog--success" role="dialog" aria-modal="true" aria-labelledby="assetPhotoPreviewTitle">
                    <div class="review-action-modal__actions" style="justify-content:flex-end;margin-top:0">
                        <button type="button" class="new-app-btn new-app-btn--secondary" data-photo-preview-close aria-label="Close photo preview">Close</button>
                    </div>
                    <span class="review-action-modal__eyebrow">Asset Photo Preview</span>
                    <h2 id="assetPhotoPreviewTitle"></h2>
                    <img id="assetPhotoPreviewImage" alt="Selected asset photo preview" style="display:block;max-width:100%;max-height:70vh;margin:16px auto 0;object-fit:contain">
                </section>
            </div>
        </div>
    </main>
    <script src="<?= base_url('assets/js/sidebar.js') ?>"></script>
    <script src="<?= base_url('assets/js/appraisal-upload.js') ?>?v=<?= filemtime(FCPATH . 'assets/js/appraisal-upload.js') ?>"></script>
</body>

</html>
