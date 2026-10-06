<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Appraisal Summary &ndash; Aggre Capital Dashboard</title>
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
                <a href="<?= base_url('appraisal-task') ?>">Scheduling &amp; Site Visit</a><span>/</span>
                <span>Asset Appraisal Summary</span>
            </nav>
            <a class="appraisal-workspace__back" href="<?= base_url('appraisal-task') ?>"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Back to site visit</a>
        </header>
        <div class="appraisal-workspace__content">
            <section class="appraisal-task-heading">
                <div>
                    <span class="appraisal-task-heading__eyebrow">Per Collateral</span>
                    <h1>Asset Appraisal Summary</h1>
                    <p><?= esc($applicationNo ?: 'Appraisal Task') ?> &bull; <?= esc($borrower ?: 'Borrower') ?> &bull; <?= esc($collateral ?: 'Collateral') ?></p>
                </div>
                <span class="appraisal-task-heading__status"><i class="fa-solid fa-circle" aria-hidden="true"></i>Site Visit Completed</span>
            </section>

            <section class="new-app-progress-card appraisal-process-progress" aria-label="Appraisal process progress">
                <div class="new-app-progress-scroll">
                    <nav class="new-app-progress-track" aria-label="Appraisal steps">
                        <span class="new-app-progress-step is-completed"><span class="new-app-progress-step__number"><i class="fa-solid fa-check" aria-hidden="true"></i></span><span class="new-app-progress-step__label">Task Assignment</span></span>
                        <span class="new-app-progress-line is-completed" aria-hidden="true"></span>
                        <span class="new-app-progress-step is-completed"><span class="new-app-progress-step__number"><i class="fa-solid fa-check" aria-hidden="true"></i></span><span class="new-app-progress-step__label">Scheduling &amp; Site Visit</span></span>
                        <span class="new-app-progress-line is-completed" aria-hidden="true"></span>
                        <span class="new-app-progress-step is-active" aria-current="step"><span class="new-app-progress-step__number">3</span><span class="new-app-progress-step__label">Asset Appraisal Summary</span></span>
                        <span class="new-app-progress-line" aria-hidden="true"></span>
                        <span class="new-app-progress-step"><span class="new-app-progress-step__number">4</span><span class="new-app-progress-step__label">Upload Appraisal Results</span></span>
                        <span class="new-app-progress-line" aria-hidden="true"></span>
                        <span class="new-app-progress-step"><span class="new-app-progress-step__number">5</span><span class="new-app-progress-step__label">Submit Appraisal Results</span></span>
                    </nav>
                </div>
            </section>

            <form id="assetAppraisalSummaryForm" class="new-app-application-stack" data-upload-url="<?= base_url('appraisal-upload') ?>">
                <section class="new-app-form-card">
                    <h2 class="new-app-form-card__title">Report Header</h2>
                    <div class="application-parameters-grid">
                        <div class="new-app-field"><label class="new-app-field__label" for="reportNumber">Report Number</label><div class="new-app-control new-app-control--readonly" id="reportNumber"></div></div>
                        <div class="new-app-field"><label class="new-app-field__label" for="summaryBorrower">Borrower / Prospective Borrower</label><input class="new-app-control" id="summaryBorrower" value="<?= esc($borrower) ?>" readonly></div>
                        <div class="new-app-field"><label class="new-app-field__label" for="summaryCollateral">Collateral Type</label><input class="new-app-control" id="summaryCollateral" value="<?= esc($collateral) ?>" readonly></div>
                        <div class="new-app-field"><label class="new-app-field__label" for="fieldCorrectionNote">Collateral Type Correction Note</label><input class="new-app-control" id="fieldCorrectionNote" name="field_correction_note" placeholder="Add a note if field conditions differ"></div>
                        <div class="new-app-field"><label class="new-app-field__label" for="surveyDate">Appraisal / Survey Date <span>*</span></label><input class="new-app-control" id="surveyDate" name="survey_date" type="date" value="<?= esc($surveyDate) ?>" required></div>
                        <div class="new-app-field"><label class="new-app-field__label" for="reportDate">Report Date <span>*</span></label><input class="new-app-control" id="reportDate" name="report_date" type="date" required></div>
                        <div class="new-app-field"><label class="new-app-field__label" for="valuationPurpose">Valuation Purpose <span>*</span></label><select class="new-app-control" id="valuationPurpose" name="valuation_purpose" required><option value="loan_collateral">Loan Collateral</option><option value="other">Other</option></select></div>
                        <div class="new-app-field"><label class="new-app-field__label" for="summaryAppraiser">Appraiser</label><input class="new-app-control" id="summaryAppraiser" value="<?= esc($appraiser) ?>" readonly></div>
                    </div>
                </section>

                <section class="new-app-form-card">
                    <h2 class="new-app-form-card__title">Valuation Inputs</h2>
                    <p>Enter the relevant land and building/unit figures for each calculation basis. Missing IMB area is calculated as zero.</p>
                    <div class="application-parameters-grid">
                        <div class="new-app-field"><label class="new-app-field__label" for="liquidationPercent">Liquidation Percentage (%) <span>*</span></label><input class="new-app-control" id="liquidationPercent" name="liquidation_percent" type="number" min="0" max="100" step="0.01" value="60" required></div>
                        <div class="new-app-field new-app-field--full"><label class="new-app-field__label" for="liquidationJustification">Justification for Percentage Change</label><textarea class="new-app-textarea" id="liquidationJustification" name="liquidation_justification" rows="2" placeholder="Required if the default 60% is changed"></textarea></div>
                    </div>
                </section>

                <?php foreach ([
                    'physical' => ['1. Based on Physical Building Area', 'Physical area (m²)', 'Market value per m² (IDR)', 'Market Value (IDR)'],
                    'imb' => ['2. Based on Building Permit (IMB) Area', 'IMB area (m²)', 'Market value per m² (IDR)', 'Market Value (IDR)'],
                    'pbb' => ['3. Based on Property Tax (PBB) Area', 'PBB area (m²)', 'NJOP per m² (IDR)', 'NJOP Value (IDR)'],
                ] as $basis => $labels): ?>
                    <section class="new-app-form-card" data-basis-card="<?= esc($basis) ?>">
                        <h2 class="new-app-form-card__title"><?= esc($labels[0]) ?></h2>
                        <div class="table-wrap">
                            <table class="data-table">
                                <thead><tr><th>Component</th><th><?= esc($labels[1]) ?></th><th><?= esc($labels[2]) ?></th><th>Calculated Market Value (IDR)</th><th>Calculated Liquidation Value (IDR)</th></tr></thead>
                                <tbody>
                                    <?php foreach (['Land', 'Building / Unit'] as $part): ?>
                                        <tr data-value-row>
                                            <td><?= esc($part) ?></td>
                                            <td><input class="new-app-control" data-area-input="<?= esc($basis) ?>" type="number" min="0" step="0.01" placeholder="0" aria-label="<?= esc($part . ' ' . $labels[1]) ?>"></td>
                                            <td><input class="new-app-control" data-rate-input="<?= esc($basis) ?>" type="number" min="0" step="0.01" placeholder="0" aria-label="<?= esc($part . ' ' . $labels[2]) ?>"></td>
                                            <td><div class="new-app-control new-app-control--readonly" data-row-market>IDR 0</div></td>
                                            <td><div class="new-app-control new-app-control--readonly" data-row-liquidation>IDR 0</div></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot><tr><th colspan="3">Basis Total</th><td><strong data-market-total="<?= esc($basis) ?>">IDR 0</strong></td><td><strong data-liquidation-total="<?= esc($basis) ?>">IDR 0</strong></td></tr></tfoot>
                            </table>
                        </div>
                        <?php if ($basis === 'imb'): ?><p>When no IMB area is available, enter 0.</p><?php elseif ($basis === 'pbb'): ?><p>The total NJOP value can be used to update the corresponding NJOP value in the collateral data.</p><?php endif; ?>
                    </section>
                <?php endforeach; ?>

                <section class="new-app-form-card">
                    <h2 class="new-app-form-card__title">Final Appraisal Values</h2>
                    <p>When the physical area differs from the supporting documents, consider using the lowest applicable value and record the reason in the correction note.</p>
                    <div class="application-parameters-grid">
                        <div class="new-app-field"><label class="new-app-field__label" for="finalBasis">Final Value Basis <span>*</span></label><select class="new-app-control" id="finalBasis" name="final_basis" required><option value="physical">Physical Area</option><option value="imb">IMB Area</option><option value="pbb">PBB Area</option></select></div>
                        <div class="new-app-field"><label class="new-app-field__label">Final Appraisal Market Value (IDR)</label><div class="new-app-control new-app-control--readonly" id="finalMarketValue">IDR 0</div></div>
                        <div class="new-app-field"><label class="new-app-field__label">Final Liquidation Value (IDR)</label><div class="new-app-control new-app-control--readonly" id="finalLiquidationValue">IDR 0</div></div>
                    </div>
                </section>
                <footer class="new-app-page-actions">
                    <span class="new-app-page-actions__info">Values are calculated from the selected basis. Prototype entries are not saved to the server.</span>
                    <div class="new-app-page-actions__buttons"><a class="new-app-btn new-app-btn--secondary" href="<?= base_url('appraisal-list') ?>">Back to Task List</a><button type="button" class="new-app-btn new-app-btn--secondary" id="saveAssetSummary">Save Draft</button><button type="submit" class="new-app-btn new-app-btn--primary" id="completeAssetSummary">Continue to Upload Results</button></div>
                </footer>
                <p id="assetSummaryFeedback" class="appraisal-task-feedback" role="status" hidden></p>
            </form>
        </div>
    </main>
    <script src="<?= base_url('assets/js/sidebar.js') ?>"></script>
    <script src="<?= base_url('assets/js/asset-appraisal-summary.js') ?>"></script>
</body>
</html>
