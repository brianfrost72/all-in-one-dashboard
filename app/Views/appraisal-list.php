<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Appraisal Task List &ndash; Aggre Capital Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/sidebar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/anim.css') ?>">
</head>

<body>

    <?= $this->include('layouts/sidebar') ?>

    <main class="main-section">
        <header class="top-header">
            <div class="top-header__inner">
                <nav class="top-header__breadcrumb" aria-label="Breadcrumb">
                    <a href="#">Dashboard</a>
                    <span class="top-header__breadcrumb-separator">/</span>
                    <span class="top-header__breadcrumb-current">Collateral Appraisal</span>
                    <span class="top-header__breadcrumb-separator">/</span>
                    <span class="top-header__breadcrumb-current">Appraisal Task List</span>
                </nav>

                <form class="top-header__search" role="search">
                    <i class="fa-solid fa-magnifying-glass top-header__search-icon" aria-hidden="true"></i>
                    <input class="top-header__search-input" type="search"
                        placeholder="Search application, borrower, NIK/NIB, contract number..."
                        aria-label="Search application">
                </form>

                <div class="top-header__actions">
                    <button class="top-header__filter" type="button">
                        <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                        <span class="top-header__filter-label">All Branches</span>
                        <i class="fa-solid fa-chevron-down top-header__chevron" aria-hidden="true"></i>
                    </button>

                    <button class="top-header__filter" type="button">
                        <i class="fa-regular fa-calendar" aria-hidden="true"></i>
                        <span class="top-header__filter-label">This Month</span>
                        <i class="fa-solid fa-chevron-down top-header__chevron" aria-hidden="true"></i>
                    </button>

                    <button class="top-header__notification" id="notificationTrigger" type="button"
                        aria-label="Open notifications" aria-haspopup="dialog" aria-controls="notificationModal"
                        aria-expanded="false">
                        <i class="fa-regular fa-bell" aria-hidden="true"></i>
                        <span class="top-header__notification-badge" id="notificationHeaderBadge">5</span>
                    </button>
                </div>
            </div>
        </header>

        <!-- Notification drawer modal -->
        <div class="notification-modal" id="notificationModal" hidden>
            <button class="notification-modal__backdrop" type="button" aria-label="Close notifications"></button>

            <aside class="notification-drawer" role="dialog" aria-modal="true" aria-labelledby="notificationTitle"
                tabindex="-1">

                <div class="notification-drawer__header">
                    <div class="notification-drawer__title-row">
                        <div class="notification-drawer__title-group">
                            <h2 id="notificationTitle">Notifications</h2>
                            <span class="notification-unread-badge" id="notificationUnreadBadge">5 unread</span>
                        </div>

                        <button class="notification-mark-read" id="notificationMarkRead" type="button">
                            Mark all as read
                        </button>
                    </div>

                    <div class="notification-tabs" role="tablist" aria-label="Notification filters">
                        <button class="notification-tab is-active" type="button" role="tab" aria-selected="true"
                            data-notification-filter="all">All</button>
                        <button class="notification-tab" type="button" role="tab" aria-selected="false"
                            data-notification-filter="unread">Unread</button>
                        <button class="notification-tab" type="button" role="tab" aria-selected="false"
                            data-notification-filter="mentions">Mentions</button>
                    </div>
                </div>

                <div class="notification-drawer__body" id="notificationList">
                    <article class="notification-item notification-item--info is-unread"
                        data-notification-type="unread">
                        <span class="notification-item__rail" aria-hidden="true"></span>
                        <div class="notification-item__icon">
                            <i class="fa-solid fa-list-check" aria-hidden="true"></i>
                        </div>
                        <div class="notification-item__content">
                            <p class="notification-item__message">Application LOS-JKT-202609-0142 has been assigned to
                                you.</p>
                            <div class="notification-item__meta">
                                <span>2 minutes ago</span><span>•</span><span>System</span>
                            </div>
                            <button class="notification-item__action notification-item__action--primary"
                                type="button">Open Application</button>
                        </div>
                    </article>

                    <article class="notification-item notification-item--info is-unread"
                        data-notification-type="unread">
                        <span class="notification-item__rail" aria-hidden="true"></span>
                        <div class="notification-item__icon">
                            <i class="fa-regular fa-circle-check" aria-hidden="true"></i>
                        </div>
                        <div class="notification-item__content">
                            <p class="notification-item__message">Appraisal for PT Sinar Abadi has been completed.
                                Market Value: Rp 1.50 B, Liquidation Value: Rp 1.15 B.</p>
                            <div class="notification-item__meta">
                                <span>45 minutes ago</span><span>•</span><span>Rudi Hermawan (Appraisal Staff)</span>
                            </div>
                            <button class="notification-item__action" type="button">View Appraisal</button>
                        </div>
                    </article>

                    <article class="notification-item notification-item--warning is-unread"
                        data-notification-type="unread">
                        <span class="notification-item__rail" aria-hidden="true"></span>
                        <div class="notification-item__icon">
                            <i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i>
                        </div>
                        <div class="notification-item__content">
                            <p class="notification-item__message">Application LOS-BDG-202609-0138 will exceed SLA in 4
                                hours. Current stage: Credit Analysis.</p>
                            <div class="notification-item__meta">
                                <span>1 hour ago</span><span>•</span><span>System — SLA Alert</span>
                            </div>
                            <button class="notification-item__action" type="button">Open Application</button>
                        </div>
                    </article>

                    <article class="notification-item notification-item--revision is-unread"
                        data-notification-type="mention">
                        <span class="notification-item__rail" aria-hidden="true"></span>
                        <div class="notification-item__icon">
                            <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                        </div>
                        <div class="notification-item__content">
                            <p class="notification-item__message">Committee returned application LOS-JKT-202609-0131 for
                                revision. Reason: Additional collateral analysis required.</p>
                            <div class="notification-item__meta">
                                <span>2 hours ago</span><span>•</span><span>Budi Hartono (VP Business)</span>
                            </div>
                            <button class="notification-item__action" type="button">View Details</button>
                        </div>
                    </article>

                    <article class="notification-item notification-item--danger is-unread"
                        data-notification-type="unread">
                        <span class="notification-item__rail" aria-hidden="true"></span>
                        <div class="notification-item__icon">
                            <i class="fa-solid fa-circle-exclamation" aria-hidden="true"></i>
                        </div>
                        <div class="notification-item__content">
                            <p class="notification-item__message">Payment for contract CTR-JKT-2026-0098 is overdue by 7
                                days. Borrower: CV Maju Bersama. Outstanding: Rp 15,800,000.</p>
                            <div class="notification-item__meta">
                                <span>3 hours ago</span><span>•</span><span>System — Collection Alert</span>
                            </div>
                            <button class="notification-item__action" type="button">View Contract</button>
                        </div>
                    </article>

                    <article class="notification-item notification-item--neutral" data-notification-type="read">
                        <span class="notification-item__rail" aria-hidden="true"></span>
                        <div class="notification-item__icon">
                            <i class="fa-regular fa-file-lines" aria-hidden="true"></i>
                        </div>
                        <div class="notification-item__content">
                            <p class="notification-item__message">Application LOS-SBY-202609-0127 has been submitted to
                                Committee L1.</p>
                            <div class="notification-item__meta">
                                <span>Yesterday</span><span>•</span><span>System</span>
                            </div>
                            <button class="notification-item__action" type="button">View Application</button>
                        </div>
                    </article>

                    <article class="notification-item notification-item--neutral" data-notification-type="mention">
                        <span class="notification-item__rail" aria-hidden="true"></span>
                        <div class="notification-item__icon">
                            <i class="fa-regular fa-comment-dots" aria-hidden="true"></i>
                        </div>
                        <div class="notification-item__content">
                            <p class="notification-item__message">You were mentioned in a note for application
                                LOS-JKT-202609-0098.</p>
                            <div class="notification-item__meta">
                                <span>Yesterday</span><span>•</span><span>Rina S.</span>
                            </div>
                            <button class="notification-item__action" type="button">View Mention</button>
                        </div>
                    </article>

                    <div class="notification-empty" id="notificationEmpty" hidden>
                        <div class="notification-empty__icon">
                            <i class="fa-regular fa-bell-slash" aria-hidden="true"></i>
                        </div>
                        <strong>No notifications here</strong>
                        <span>You're all caught up for this filter.</span>
                    </div>
                </div>

                <div class="notification-drawer__footer">
                    <button class="notification-footer__link" type="button">View All Notifications</button>
                    <span class="notification-footer__separator" aria-hidden="true"></span>
                    <button class="notification-footer__link" type="button">Notification Settings</button>
                </div>
            </aside>
        </div>

        <div class="main-container">
            <section class="kpi-row" aria-label="Appraisal task summary"
                style="grid-template-columns: repeat(4, minmax(0, 1fr));">
                <article class="kpi-card" tabindex="0">
                    <div class="kpi-card__head"><span class="kpi-card__label">Total Appraisal Tasks</span><i
                            class="fa-solid fa-list-check kpi-card__trend-icon" aria-hidden="true"></i></div>
                    <p class="kpi-card__value">24</p>
                    <div class="kpi-card__meta"><span>Tasks in the current queue</span></div>
                </article>
                <article class="kpi-card" tabindex="0">
                    <div class="kpi-card__head"><span class="kpi-card__label">Awaiting Assignment</span><span
                            class="kpi-card__attention">Needs assignment</span></div>
                    <p class="kpi-card__value">6</p>
                    <div class="kpi-card__meta"><span>Ready for appraiser assignment</span></div>
                </article>
                <article class="kpi-card" tabindex="0">
                    <div class="kpi-card__head"><span class="kpi-card__label">In Progress</span><i
                            class="fa-solid fa-spinner kpi-card__trend-icon icon-spin" aria-hidden="true"></i></div>
                    <p class="kpi-card__value">13</p>
                    <div class="kpi-card__meta"><span>Assigned appraisal tasks</span></div>
                </article>
                <article class="kpi-card" tabindex="0">
                    <div class="kpi-card__head"><span class="kpi-card__label">SLA at Risk</span><i
                            class="fa-solid fa-triangle-exclamation kpi-card__trend-icon" aria-hidden="true"></i></div>
                    <p class="kpi-card__value">3</p>
                    <div class="kpi-card__meta kpi-card__meta--danger"><strong>Follow up</strong><span>before
                            deadline</span></div>
                </article>
            </section>

            <div class="info-banner">
                <i class="fa-solid fa-circle-info" aria-hidden="true"></i>
                <div>
                    <strong>Appraiser assignment</strong>
                    <p>
                        Appraisers may be assigned or reassigned manually by the appraisal coordinator, or assigned
                        automatically by branch according to the configured appraisal assignment parameters.
                    </p>
                </div>
            </div>

            <section class="app-list-filterbar" aria-label="Appraisal task filters">
                <div class="app-list-filter app-list-filter--keyword">
                    <label for="appraisalKeyword">Keyword</label>
                    <div class="app-list-filter__search"><i class="fa-solid fa-magnifying-glass"
                            aria-hidden="true"></i><input type="search" id="appraisalKeyword"
                            placeholder="Search app no., borrower name..."></div>
                </div>
                <div class="app-list-filter app-list-filter--status">
                    <label for="appraisalStatus">Appraisal Sub-status</label>
                    <select id="appraisalStatus">
                        <option>All Statuses</option>
                        <option>Awaiting Assignment</option>
                        <option>Site Visit Scheduled</option>
                        <option>Assessment in Progress</option>
                        <option>Report Submitted</option>
                    </select>
                </div>
                <div class="app-list-filter app-list-filter--branch">
                    <label for="appraisalBranch">Branch</label>
                    <select id="appraisalBranch">
                        <option>All Branches</option>
                        <option>Jakarta</option>
                        <option>Bandung</option>
                        <option>Surabaya</option>
                        <option>Bali</option>
                    </select>
                </div>
                <div class="app-list-filter app-list-filter--sla">
                    <label for="appraisalSla">SLA Status</label>
                    <select id="appraisalSla">
                        <option>All</option>
                        <option>On Track</option>
                        <option>SLA Risk</option>
                        <option>Overdue</option>
                    </select>
                </div>
                <div class="app-list-filter__actions">
                    <button class="app-list-filter__clear" type="button">Clear Filters</button>
                    <button class="app-list-filter__apply" type="button">Apply</button>
                </div>
            </section>

            <section class="panel" aria-label="Appraisal task list">
                <div class="table-wrap">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No Aplikasi</th>
                                <th>Borrower Name</th>
                                <th>Collateral Type</th>
                                <th>Collateral Address</th>
                                <th>Branch</th>
                                <th>Appraiser</th>
                                <th>Assigned Date</th>
                                <th>Appraisal Sub-status</th>
                                <th>SLA Remaining</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>LOS-JKT-202610-0142</td>
                                <td>PT Sinar Abadi</td>
                                <td>Commercial Property</td>
                                <td>Jl. Gatot Subroto No. 18, Jakarta Selatan</td>
                                <td>Jakarta</td>
                                <td>Rudi Hermawan</td>
                                <td>02 Oct 2026</td>
                                <td><span class="app-list-status app-list-status--verification">Site Visit
                                        Scheduled</span></td>
                                <td><span class="app-list-sla app-list-sla--warning"><i
                                            class="fa-regular fa-clock"></i>2 days</span></td>
                                <td>
                                    <div class="app-list-actions"><button type="button" data-appraiser-action>Reassign</button><button type="button" data-open-task data-task-url="<?= base_url('appraisal-task') ?>">Open Task</button><button
                                            type="button"
                                            title="Read-only collateral, owner, and collateral documents">View
                                            Data</button></div>
                                </td>
                            </tr>
                            <tr>
                                <td>LOS-BDG-202610-0139</td>
                                <td>Budi Santoso</td>
                                <td>Residential Property</td>
                                <td>Jl. Setiabudi No. 45, Bandung</td>
                                <td>Bandung</td>
                                <td>Unassigned</td>
                                <td>—</td>
                                <td><span class="app-list-status app-list-status--draft">Awaiting Assignment</span></td>
                                <td><span class="app-list-sla app-list-sla--warning"><i
                                            class="fa-regular fa-clock"></i>6 hours</span></td>
                                <td>
                                    <div class="app-list-actions"><button type="button" data-appraiser-action>Assign Appraiser</button><button
                                            type="button" data-open-task data-task-url="<?= base_url('appraisal-task') ?>" disabled title="Assign an appraiser first">Open Task</button><button type="button"
                                            title="Read-only collateral, owner, and collateral documents">View
                                            Data</button></div>
                                </td>
                            </tr>
                            <tr>
                                <td>LOS-SBY-202610-0137</td>
                                <td>CV Maju Bersama</td>
                                <td>Heavy Equipment</td>
                                <td>Jl. Margomulyo Indah Blok A-7, Surabaya</td>
                                <td>Surabaya</td>
                                <td>Andi Pratama</td>
                                <td>01 Oct 2026</td>
                                <td><span class="app-list-status app-list-status--verification">Assessment in
                                        Progress</span></td>
                                <td><span class="app-list-sla app-list-sla--warning"><i
                                            class="fa-regular fa-clock"></i>1 day</span></td>
                                <td>
                                    <div class="app-list-actions"><button type="button" data-appraiser-action>Reassign</button><button type="button" data-open-task data-task-url="<?= base_url('appraisal-task') ?>">Open Task</button><button
                                            type="button"
                                            title="Read-only collateral, owner, and collateral documents">View
                                            Data</button></div>
                                </td>
                            </tr>
                            <tr>
                                <td>LOS-DPS-202610-0134</td>
                                <td>Ni Luh Putu Aryani</td>
                                <td>Land</td>
                                <td>Jl. Sunset Road No. 88, Badung</td>
                                <td>Bali</td>
                                <td>Made Wirawan</td>
                                <td>30 Sep 2026</td>
                                <td><span class="app-list-status app-list-status--approved">Report Submitted</span></td>
                                <td><span class="app-list-sla">Completed</span></td>
                                <td>
                                    <div class="app-list-actions"><button type="button" data-appraiser-action>Reassign</button><button type="button" data-open-task data-task-url="<?= base_url('appraisal-task') ?>">Review Appraisal</button><button
                                            type="button"
                                            title="Read-only collateral, owner, and collateral documents">View
                                            Data</button></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <footer class="table-footer">
                    <p>Showing <strong>1–4</strong> of <strong>24</strong> appraisal tasks</p>
                    <nav class="table-pagination" aria-label="Appraisal task pagination">
                        <button type="button" class="btn btn-secondary table-pagination__button"
                            aria-label="Previous page"><i class="fa-solid fa-chevron-left"></i></button>
                        <button type="button" class="btn btn-dark table-pagination__button"
                            aria-current="page">1</button>
                        <button type="button" class="btn btn-secondary table-pagination__button">2</button>
                        <button type="button" class="btn btn-secondary table-pagination__button">3</button>
                        <button type="button" class="btn btn-secondary table-pagination__button"
                            aria-label="Next page"><i class="fa-solid fa-chevron-right"></i></button>
                    </nav>
                    <label class="table-footer__rows"><span>Rows per page:</span><select class="select"
                            aria-label="Rows per page">
                            <option>10</option>
                            <option>25</option>
                            <option>50</option>
                        </select></label>
                </footer>
            </section>
        </div>
    </main>

    <div class="assignment-modal" id="appraiserAssignmentModal" hidden>
        <button class="assignment-modal__backdrop" type="button" data-assignment-close aria-label="Close assignment dialog"></button>
        <section class="assignment-dialog" role="dialog" aria-modal="true" aria-labelledby="assignmentTitle" aria-describedby="assignmentDescription" tabindex="-1">
            <header class="assignment-dialog__header">
                <div>
                    <span class="assignment-dialog__eyebrow">Collateral Appraisal</span>
                    <h2 id="assignmentTitle">Assign Appraiser</h2>
                    <p id="assignmentDescription">Choose an appraiser to handle this collateral appraisal.</p>
                </div>
                <button class="assignment-dialog__close" type="button" data-assignment-close aria-label="Close">&times;</button>
            </header>
            <div class="assignment-dialog__application">
                <span>Application Number</span><strong data-assignment-application></strong>
                <span>Borrower</span><strong data-assignment-borrower></strong>
                <span>Branch</span><strong data-assignment-branch></strong>
                <span>Current Appraiser</span><strong data-assignment-current></strong>
            </div>
            <form id="appraiserAssignmentForm">
                <label class="assignment-dialog__field" for="appraiserSelect">New Appraiser <span>*</span>
                    <select id="appraiserSelect" required>
                        <option value="">Select an appraiser</option>
                    </select>
                </label>
                <label class="assignment-dialog__field" for="assignmentReason" id="assignmentReasonField" hidden>Reason for Reassignment <span>*</span>
                    <textarea id="assignmentReason" rows="3" placeholder="For example: workload adjustment or territory change"></textarea>
                </label>
                <p class="assignment-dialog__note"><i class="fa-solid fa-circle-info" aria-hidden="true"></i> This prototype updates the list display only. Permanent storage requires a backend endpoint.</p>
                <div class="assignment-dialog__feedback" id="assignmentFeedback" role="status" hidden></div>
                <footer class="assignment-dialog__actions">
                    <button type="button" class="assignment-dialog__cancel" data-assignment-close>Cancel</button>
                    <button type="submit" class="assignment-dialog__submit" id="assignmentSubmit">Assign Appraiser</button>
                </footer>
            </form>
        </section>
    </div>

    <script src="<?= base_url('assets/js/sidebar.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <script src="<?= base_url('assets/js/appraisal-list.js') ?>"></script>
</body>

</html>
