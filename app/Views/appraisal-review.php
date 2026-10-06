<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Appraisal Results &ndash; Aggre Capital Dashboard</title>
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
                <a href="<?= base_url('appraisal-upload') ?>?<?= http_build_query(array_filter(['application' => $applicationNo, 'borrower' => $borrower, 'collateral' => $collateral, 'address' => $address, 'branch' => $branch, 'appraiser' => $appraiser])) ?>">Upload Appraisal Results</a><span>/</span>
                <span>Review &amp; Submit</span>
            </nav>
            <a class="appraisal-workspace__back" href="<?= base_url('appraisal-upload') ?>?<?= http_build_query(array_filter(['application' => $applicationNo, 'borrower' => $borrower, 'collateral' => $collateral, 'address' => $address, 'branch' => $branch, 'appraiser' => $appraiser])) ?>"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Back to uploads</a>
        </header>
        <div class="appraisal-workspace__content">
            <section class="appraisal-task-heading">
                <div>
                    <span class="appraisal-task-heading__eyebrow">Final Review</span>
                    <h1>Review Appraisal Results</h1>
                    <p><?= esc($applicationNo ?: 'Appraisal Task') ?> &bull; <?= esc($borrower ?: 'Borrower') ?> &bull; <?= esc($collateral ?: 'Collateral') ?></p>
                </div>
                <span class="appraisal-task-heading__status"><i class="fa-solid fa-circle" aria-hidden="true"></i>Ready for Review</span>
            </section>

            <section class="new-app-progress-card appraisal-process-progress" aria-label="Appraisal process progress">
                <div class="new-app-progress-scroll"><nav class="new-app-progress-track" aria-label="Appraisal steps">
                    <span class="new-app-progress-step is-completed"><span class="new-app-progress-step__number"><i class="fa-solid fa-check" aria-hidden="true"></i></span><span class="new-app-progress-step__label">Task Assignment</span></span>
                    <span class="new-app-progress-line is-completed" aria-hidden="true"></span>
                    <span class="new-app-progress-step is-completed"><span class="new-app-progress-step__number"><i class="fa-solid fa-check" aria-hidden="true"></i></span><span class="new-app-progress-step__label">Scheduling &amp; Site Visit</span></span>
                    <span class="new-app-progress-line is-completed" aria-hidden="true"></span>
                    <span class="new-app-progress-step is-completed"><span class="new-app-progress-step__number"><i class="fa-solid fa-check" aria-hidden="true"></i></span><span class="new-app-progress-step__label">Asset Appraisal Summary</span></span>
                    <span class="new-app-progress-line is-completed" aria-hidden="true"></span>
                    <span class="new-app-progress-step is-completed"><span class="new-app-progress-step__number"><i class="fa-solid fa-check" aria-hidden="true"></i></span><span class="new-app-progress-step__label">Upload Appraisal Results</span></span>
                    <span class="new-app-progress-line is-completed" aria-hidden="true"></span>
                    <span class="new-app-progress-step is-active" data-review-final-step aria-current="step"><span class="new-app-progress-step__number">5</span><span class="new-app-progress-step__label">Submit Appraisal Results</span></span>
                </nav></div>
            </section>

            <div class="new-app-application-stack">
                <section class="new-app-form-card">
                    <h2 class="new-app-form-card__title">1. Task Assignment</h2>
                    <div class="application-parameters-grid">
                        <div class="new-app-field"><label class="new-app-field__label">Application Number</label><div class="new-app-control new-app-control--readonly"><?= esc($applicationNo ?: '—') ?></div></div>
                        <div class="new-app-field"><label class="new-app-field__label">Borrower</label><div class="new-app-control new-app-control--readonly"><?= esc($borrower ?: '—') ?></div></div>
                        <div class="new-app-field"><label class="new-app-field__label">Collateral Type</label><div class="new-app-control new-app-control--readonly"><?= esc($collateral ?: '—') ?></div></div>
                        <div class="new-app-field"><label class="new-app-field__label">Assigned Appraiser</label><div class="new-app-control new-app-control--readonly" data-review="appraiser"><?= esc($appraiser ?: '—') ?></div></div>
                    </div>
                </section>
                <section class="new-app-form-card">
                    <h2 class="new-app-form-card__title">2. Scheduling &amp; Site Visit</h2>
                    <div class="application-parameters-grid">
                        <div class="new-app-field"><label class="new-app-field__label">Appraiser Type</label><div class="new-app-control new-app-control--readonly" data-review="appraiserType">—</div></div>
                        <div class="new-app-field"><label class="new-app-field__label">Survey Date &amp; Time</label><div class="new-app-control new-app-control--readonly" data-review="scheduledAt">—</div></div>
                        <div class="new-app-field"><label class="new-app-field__label">On-site Contact</label><div class="new-app-control new-app-control--readonly" data-review="contactName">—</div></div>
                        <div class="new-app-field"><label class="new-app-field__label">Contact Mobile Number</label><div class="new-app-control new-app-control--readonly" data-review="contactPhone">—</div></div>
                        <div class="new-app-field"><label class="new-app-field__label">Visit Outcome</label><div class="new-app-control new-app-control--readonly" data-review="visitOutcome">—</div></div>
                    </div>
                </section>
                <section class="new-app-form-card">
                    <h2 class="new-app-form-card__title">3. Asset Appraisal Summary</h2>
                    <div class="application-parameters-grid">
                        <div class="new-app-field"><label class="new-app-field__label">Report Number</label><div class="new-app-control new-app-control--readonly" data-review="reportNumber">—</div></div>
                        <div class="new-app-field"><label class="new-app-field__label">Appraisal / Survey Date</label><div class="new-app-control new-app-control--readonly" data-review="surveyDate">—</div></div>
                        <div class="new-app-field"><label class="new-app-field__label">Report Date</label><div class="new-app-control new-app-control--readonly" data-review="reportDate">—</div></div>
                        <div class="new-app-field"><label class="new-app-field__label">Valuation Purpose</label><div class="new-app-control new-app-control--readonly" data-review="valuationPurpose">—</div></div>
                        <div class="new-app-field"><label class="new-app-field__label">Final Value Basis</label><div class="new-app-control new-app-control--readonly" data-review="finalBasis">—</div></div>
                        <div class="new-app-field"><label class="new-app-field__label">Liquidation Percentage</label><div class="new-app-control new-app-control--readonly" data-review="liquidationPercent">—</div></div>
                        <div class="new-app-field"><label class="new-app-field__label">Appraisal Market Value</label><div class="new-app-control new-app-control--readonly" data-review="marketValue">—</div></div>
                        <div class="new-app-field"><label class="new-app-field__label">Final Liquidation Value</label><div class="new-app-control new-app-control--readonly" data-review="liquidationValue">—</div></div>
                        <div class="new-app-field new-app-field--full"><label class="new-app-field__label">Collateral Correction Note</label><div class="new-app-control new-app-control--readonly" data-review="correctionNote">—</div></div>
                    </div>
                </section>
                <section class="new-app-form-card">
                    <h2 class="new-app-form-card__title">4. Uploaded Appraisal Results</h2>
                    <div class="application-parameters-grid">
                        <div class="new-app-field"><label class="new-app-field__label">Asset Photos</label><div class="new-app-control new-app-control--readonly" data-review="assetPhotos">—</div><div class="appraisal-review-file-actions" data-review-file-actions="assetPhotos"></div></div>
                        <div class="new-app-field"><label class="new-app-field__label">Full Appraisal Report</label><div class="new-app-control new-app-control--readonly" data-review="appraisalReport">—</div><div class="appraisal-review-file-actions" data-review-file-actions="appraisalReport"></div></div>
                        <div class="new-app-field new-app-field--full"><label class="new-app-field__label">Collateral Legal Documents</label><div class="new-app-control new-app-control--readonly" data-review="legalDocuments">—</div><div class="appraisal-review-file-actions" data-review-file-actions="legalDocuments"></div></div>
                        <div class="new-app-field"><label class="new-app-field__label">BPN Certificate Check</label><div class="new-app-control new-app-control--readonly" data-review="bpnDocuments">—</div><div class="appraisal-review-file-actions" data-review-file-actions="bpnDocuments"></div></div>
                        <div class="new-app-field"><label class="new-app-field__label">Other Supporting Documents</label><div class="new-app-control new-app-control--readonly" data-review="otherDocuments">—</div><div class="appraisal-review-file-actions" data-review-file-actions="otherDocuments"></div></div>
                        <div class="new-app-field new-app-field--full"><label class="new-app-field__label">Photo Location &amp; Time</label><div class="new-app-control new-app-control--readonly" data-review="photoMetadata">—</div></div>
                    </div>
                </section>
                <section class="new-app-form-card">
                    <h2 class="new-app-form-card__title">5. Submit Appraisal Results</h2>
                    <p>Review each section above. Once submitted, the appraisal package is ready for the next review stage.</p>
                    <p class="appraisal-task-prototype"><i class="fa-solid fa-circle-info" aria-hidden="true"></i> Prototype: submission is recorded in this interface only. Files and appraisal data have not been sent to the server.</p>
                    <footer class="new-app-page-actions">
                        <span class="new-app-page-actions__info">You can return to the upload step before submitting.</span>
                        <div class="new-app-page-actions__buttons">
                            <a class="new-app-btn new-app-btn--secondary" href="<?= base_url('appraisal-upload') ?>?<?= http_build_query(array_filter(['application' => $applicationNo, 'borrower' => $borrower, 'collateral' => $collateral, 'address' => $address, 'branch' => $branch, 'appraiser' => $appraiser])) ?>">Back to Uploads</a>
                            <button type="button" class="new-app-btn new-app-btn--primary" id="submitReviewedAppraisal">Submit Appraisal Results</button>
                        </div>
                    </footer>
                    <p class="appraisal-task-feedback" id="appraisalReviewFeedback" role="status" hidden></p>
                </section>
            </div>
        </div>
    </main>
    <div class="review-action-modal" id="reviewAssetPhotoPreview" aria-hidden="true" hidden>
        <button type="button" class="review-action-modal__backdrop" data-review-photo-close aria-label="Close photo preview"></button>
        <section class="review-action-modal__dialog review-action-modal__dialog--success" role="dialog" aria-modal="true" aria-labelledby="reviewAssetPhotoTitle">
            <div class="review-action-modal__actions" style="justify-content:flex-end;margin-top:0">
                <button type="button" class="new-app-btn new-app-btn--secondary" data-review-photo-close aria-label="Close photo preview">Close</button>
            </div>
            <span class="review-action-modal__eyebrow">Asset Photo Preview</span>
            <h2 id="reviewAssetPhotoTitle"></h2>
            <img id="reviewAssetPhotoImage" alt="Selected appraisal file preview" style="display:block;max-width:100%;max-height:70vh;margin:16px auto 0;object-fit:contain">
        </section>
    </div>
    <script src="<?= base_url('assets/js/sidebar.js') ?>"></script>
    <script src="<?= base_url('assets/js/appraisal-review.js') ?>?v=<?= filemtime(FCPATH . 'assets/js/appraisal-review.js') ?>"></script>
</body>
</html>
