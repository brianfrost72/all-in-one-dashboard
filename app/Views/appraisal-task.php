<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appraisal Task &ndash; Aggre Capital Dashboard</title>
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
                <a href="<?= base_url('appraisal-list') ?>">Collateral Appraisal</a><span>/</span><span>Appraisal
                    Task</span>
            </nav>
            <a class="appraisal-workspace__back" href="<?= base_url('appraisal-list') ?>"><i
                    class="fa-solid fa-arrow-left" aria-hidden="true"></i> Back to task list</a>
        </header>

        <div class="appraisal-workspace__content">
            <section class="appraisal-task-heading">
                <div>
                    <span class="appraisal-task-heading__eyebrow">Appraisal Workbench</span>
                    <h1><?= esc(($applicationNo ?? '') ?: 'Appraisal Task') ?></h1>
                    <p><?= esc(($borrower ?? '') ?: 'Borrower details') ?> <span aria-hidden="true">&bull;</span>
                        <?= esc(($collateral ?? '') ?: 'Collateral') ?></p>
                </div>
                <span class="appraisal-task-heading__status"><i class="fa-solid fa-circle"
                        aria-hidden="true"></i><?= esc(($status ?? '') ?: 'Assessment in Progress') ?></span>
            </section>

            <section class="new-app-progress-card appraisal-process-progress" aria-label="Appraisal process progress">
                <div class="new-app-progress-scroll">
                    <nav class="new-app-progress-track" aria-label="Appraisal steps">
                        <span class="new-app-progress-step is-completed"><span class="new-app-progress-step__number"><i class="fa-solid fa-check" aria-hidden="true"></i></span><span class="new-app-progress-step__label">Task Assignment</span></span>
                        <span class="new-app-progress-line is-completed" aria-hidden="true"></span>
                        <span class="new-app-progress-step is-active" aria-current="step"><span class="new-app-progress-step__number">2</span><span class="new-app-progress-step__label">Scheduling &amp; Site Visit</span></span>
                        <span class="new-app-progress-line" aria-hidden="true"></span>
                        <span class="new-app-progress-step"><span class="new-app-progress-step__number">3</span><span class="new-app-progress-step__label">Asset Appraisal Summary</span></span>
                        <span class="new-app-progress-line" aria-hidden="true"></span>
                        <span class="new-app-progress-step"><span class="new-app-progress-step__number">4</span><span class="new-app-progress-step__label">Upload Appraisal Results</span></span>
                        <span class="new-app-progress-line" aria-hidden="true"></span>
                        <span class="new-app-progress-step"><span class="new-app-progress-step__number">5</span><span class="new-app-progress-step__label">Submit Appraisal Results</span></span>
                    </nav>
                </div>
            </section>

            <div class="appraisal-workspace__grid">
                <div class="appraisal-workspace__main">
                    <section class="appraisal-work-card">
                        <header class="appraisal-work-card__header">
                            <div>
                                <h2>Task overview</h2>
                                <p>Confirm the assignment details before continuing the appraisal.</p>
                            </div>
                        </header>
                        <dl class="appraisal-task-details">
                            <div>
                                <dt>Application number</dt>
                                <dd><?= esc(($applicationNo ?? '') ?: '—') ?></dd>
                            </div>
                            <div>
                                <dt>Borrower</dt>
                                <dd><?= esc(($borrower ?? '') ?: '—') ?></dd>
                            </div>
                            <div>
                                <dt>Collateral type</dt>
                                <dd><?= esc(($collateral ?? '') ?: '—') ?></dd>
                            </div>
                            <div>
                                <dt>Collateral address</dt>
                                <dd><?= esc(($address ?? '') ?: '—') ?></dd>
                            </div>
                            <div>
                                <dt>Branch</dt>
                                <dd><?= esc(($branch ?? '') ?: '—') ?></dd>
                            </div>
                            <div>
                                <dt>Assigned appraiser</dt>
                                <dd><?= esc(($appraiser ?? '') ?: '—') ?></dd>
                            </div>
                        </dl>
                    </section>

                    <section class="new-app-form-card">
                        <header class="appraisal-work-card__header">
                            <div>
                                <h2>Scheduling &amp; Site Visit</h2>
                                <p>Assign the appraiser, schedule the survey, and record the visit outcome.</p>
                            </div>
                        </header>
                        <form id="appraisalTaskForm" data-summary-url="<?= base_url('asset-appraisal-summary') ?>">
                            <div class="application-parameters-grid">
                                <label class="new-app-field new-app-field__label" for="appraiserType">Appraiser Type <span>*</span>
                                    <select class="new-app-control" id="appraiserType" name="appraiser_type" required>
                                        <option value="">Select appraiser type</option>
                                        <option value="internal">Internal</option>
                                        <option value="external">External KJPP</option>
                                    </select>
                                </label>
                                <label class="new-app-field new-app-field__label" for="internalAppraiser" id="internalAppraiserField">Appraiser Name <span>*</span>
                                    <select class="new-app-control" id="internalAppraiser" name="internal_appraiser">
                                        <option value="">Select an appraiser</option>
                                        <?php if (!empty($appraiser)): ?>
                                            <option value="<?= esc($appraiser) ?>" selected><?= esc($appraiser) ?></option>
                                        <?php endif; ?>
                                        <option>Rudi Hermawan</option>
                                        <option>Siti Permata</option>
                                        <option>Dimas Saputra</option>
                                        <option>Budi Kurniawan</option>
                                        <option>Sari Wulandari</option>
                                        <option>Andi Pratama</option>
                                        <option>Maya Lestari</option>
                                        <option>Made Wirawan</option>
                                        <option>Komang Putri</option>
                                    </select>
                                </label>
                                <label class="new-app-field new-app-field__label" for="externalKjpp" id="externalKjppField" hidden>KJPP Name <span>*</span>
                                    <input class="new-app-control" id="externalKjpp" name="external_kjpp" type="text" placeholder="Enter the KJPP name">
                                </label>
                                <label class="new-app-field new-app-field__label" for="surveyDateTime">Survey Date &amp; Time <span>*</span>
                                    <input class="new-app-control" id="surveyDateTime" type="datetime-local" name="survey_datetime" required>
                                </label>
                            </div>
                            <p class="appraisal-task-prototype"><i class="fa-solid fa-circle-info"
                                    aria-hidden="true"></i> Marketing should be notified to coordinate the survey
                                schedule with the borrower.</p>
                            <div class="application-parameters-grid">
                                <label class="new-app-field new-app-field__label" for="siteContactName">On-site Contact Person <span>*</span>
                                    <input class="new-app-control" id="siteContactName" type="text" name="site_contact_name"
                                        placeholder="Enter contact person's name" required>
                                </label>
                                <label class="new-app-field new-app-field__label" for="siteContactPhone">Contact Person's Mobile Number <span>*</span>
                                    <input class="new-app-control" id="siteContactPhone" type="tel" name="site_contact_phone"
                                        placeholder="For example: 081234567890" required>
                                </label>
                            </div>
                            <label class="new-app-field new-app-field__label" for="visitOutcome">Visit Outcome <span>*</span>
                                <select class="new-app-control" id="visitOutcome" name="visit_outcome" required>
                                    <option value="">Select visit outcome</option>
                                    <option value="successful">Successful</option>
                                    <option value="reschedule">Failed – Reschedule</option>
                                </select>
                            </label>
                            <div class="application-parameters-grid" id="rescheduleFields" hidden>
                                <label class="new-app-field new-app-field__label new-app-field--full" for="failureReason">Reason for Failed Survey <span>*</span>
                                    <textarea class="new-app-textarea" id="failureReason" name="failure_reason" rows="3"
                                        placeholder="Explain why the survey failed and needs to be rescheduled"></textarea>
                                </label>
                                <label class="new-app-field new-app-field__label" for="rescheduleDateTime">New Survey Date &amp; Time <span>*</span>
                                    <input class="new-app-control" id="rescheduleDateTime" type="datetime-local" name="reschedule_datetime">
                                </label>
                            </div>
                            <p class="appraisal-task-prototype"><i class="fa-solid fa-circle-info"
                                    aria-hidden="true"></i> Prototype: data is not saved to the server, and no
                                notification has been sent to Marketing.</p>
                            <footer class="new-app-page-actions">
                                <span class="new-app-page-actions__info">Complete the required fields to continue.</span>
                                <div class="new-app-page-actions__buttons">
                                    <button type="button" class="new-app-btn new-app-btn--secondary" id="saveAppraisalDraft">Save Draft</button>
                                    <button type="submit" class="new-app-btn new-app-btn--primary" id="saveVisitDetails">Continue to Asset Appraisal Summary</button>
                                </div>
                            </footer>
                            <p class="appraisal-task-feedback" id="appraisalTaskFeedback" role="status" hidden></p>
                        </form>
                    </section>
                </div>

                <aside class="appraisal-workspace__side">
                    <section class="appraisal-work-card appraisal-task-sla">
                        <span class="appraisal-task-sla__label">SLA remaining</span>
                        <strong><?= esc(($sla ?? '') ?: '—') ?></strong>
                        <p>Complete the assessment within the assigned service level.</p>
                    </section>
                    <section class="appraisal-work-card">
                        <header class="appraisal-work-card__header">
                            <div>
                                <h2>Before you start</h2>
                            </div>
                        </header>
                        <ul class="appraisal-task-checklist">
                            <li><i class="fa-regular fa-square-check" aria-hidden="true"></i>Confirm internal appraiser
                                or KJPP assignment</li>
                            <li><i class="fa-regular fa-square-check" aria-hidden="true"></i>Coordinate the survey
                                schedule with Marketing and the borrower</li>
                            <li><i class="fa-regular fa-square-check" aria-hidden="true"></i>Record the location contact
                                and visit outcome</li>
                        </ul>
                    </section>
                </aside>
            </div>
        </div>
    </main>
    <script src="<?= base_url('assets/js/sidebar.js') ?>"></script>
    <script src="<?= base_url('assets/js/appraisal-task.js') ?>"></script>
</body>

</html>
