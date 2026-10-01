<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Draft Application Lists &ndash; Aggre Capital Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/sidebar.css') ?>">
    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/main.css') ?>">
</head>

<body>

    <?= $this->include('layouts/sidebar') ?>

    <main class="main-section">
        <header class="top-header">
            <div class="top-header__inner">
                <nav class="top-header__breadcrumb" aria-label="Breadcrumb">
                    <a href="#">Dashboard</a>
                    <span class="top-header__breadcrumb-separator">/</span>
                    <span class="top-header__breadcrumb-current">Loan Applications</span>
                    <span class="top-header__breadcrumb-separator">/</span>
                    <span class="top-header__breadcrumb-current">Drafts</span>
                </nav>

                <form class="top-header__search" role="search">
                    <i class="fa-solid fa-magnifying-glass top-header__search-icon" aria-hidden="true"></i>
                    <input
                        class="top-header__search-input"
                        type="search"
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

                    <button
                        class="top-header__notification"
                        id="notificationTrigger"
                        type="button"
                        aria-label="Open notifications"
                        aria-haspopup="dialog"
                        aria-controls="notificationModal"
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

            <aside
                class="notification-drawer"
                role="dialog"
                aria-modal="true"
                aria-labelledby="notificationTitle"
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
                        <button class="notification-tab is-active" type="button" role="tab" aria-selected="true" data-notification-filter="all">All</button>
                        <button class="notification-tab" type="button" role="tab" aria-selected="false" data-notification-filter="unread">Unread</button>
                        <button class="notification-tab" type="button" role="tab" aria-selected="false" data-notification-filter="mentions">Mentions</button>
                    </div>
                </div>

                <div class="notification-drawer__body" id="notificationList">
                    <article class="notification-item notification-item--info is-unread" data-notification-type="unread">
                        <span class="notification-item__rail" aria-hidden="true"></span>
                        <div class="notification-item__icon">
                            <i class="fa-solid fa-list-check" aria-hidden="true"></i>
                        </div>
                        <div class="notification-item__content">
                            <p class="notification-item__message">Application LOS-JKT-202609-0142 has been assigned to you.</p>
                            <div class="notification-item__meta">
                                <span>2 minutes ago</span><span>•</span><span>System</span>
                            </div>
                            <button class="notification-item__action notification-item__action--primary" type="button">Open Application</button>
                        </div>
                    </article>

                    <article class="notification-item notification-item--info is-unread" data-notification-type="unread">
                        <span class="notification-item__rail" aria-hidden="true"></span>
                        <div class="notification-item__icon">
                            <i class="fa-regular fa-circle-check" aria-hidden="true"></i>
                        </div>
                        <div class="notification-item__content">
                            <p class="notification-item__message">Appraisal for PT Sinar Abadi has been completed. Market Value: Rp 1.50 B, Liquidation Value: Rp 1.15 B.</p>
                            <div class="notification-item__meta">
                                <span>45 minutes ago</span><span>•</span><span>Rudi Hermawan (Appraisal Staff)</span>
                            </div>
                            <button class="notification-item__action" type="button">View Appraisal</button>
                        </div>
                    </article>

                    <article class="notification-item notification-item--warning is-unread" data-notification-type="unread">
                        <span class="notification-item__rail" aria-hidden="true"></span>
                        <div class="notification-item__icon">
                            <i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i>
                        </div>
                        <div class="notification-item__content">
                            <p class="notification-item__message">Application LOS-BDG-202609-0138 will exceed SLA in 4 hours. Current stage: Credit Analysis.</p>
                            <div class="notification-item__meta">
                                <span>1 hour ago</span><span>•</span><span>System — SLA Alert</span>
                            </div>
                            <button class="notification-item__action" type="button">Open Application</button>
                        </div>
                    </article>

                    <article class="notification-item notification-item--revision is-unread" data-notification-type="mention">
                        <span class="notification-item__rail" aria-hidden="true"></span>
                        <div class="notification-item__icon">
                            <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
                        </div>
                        <div class="notification-item__content">
                            <p class="notification-item__message">Committee returned application LOS-JKT-202609-0131 for revision. Reason: Additional collateral analysis required.</p>
                            <div class="notification-item__meta">
                                <span>2 hours ago</span><span>•</span><span>Budi Hartono (VP Business)</span>
                            </div>
                            <button class="notification-item__action" type="button">View Details</button>
                        </div>
                    </article>

                    <article class="notification-item notification-item--danger is-unread" data-notification-type="unread">
                        <span class="notification-item__rail" aria-hidden="true"></span>
                        <div class="notification-item__icon">
                            <i class="fa-solid fa-circle-exclamation" aria-hidden="true"></i>
                        </div>
                        <div class="notification-item__content">
                            <p class="notification-item__message">Payment for contract CTR-JKT-2026-0098 is overdue by 7 days. Borrower: CV Maju Bersama. Outstanding: Rp 15,800,000.</p>
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
                            <p class="notification-item__message">Application LOS-SBY-202609-0127 has been submitted to Committee L1.</p>
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
                            <p class="notification-item__message">You were mentioned in a note for application LOS-JKT-202609-0098.</p>
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
            <section class="kpi-row" aria-label="Draft application metrics" style="grid-template-columns: minmax(240px, 320px); height: auto; min-height: 110px;">
                <article class="kpi-card kpi-card--highlight">
                    <div class="kpi-card__head">
                        <span class="kpi-card__label">Total Draft Applications</span>
                        <i class="fa-regular fa-file-lines kpi-card__trend-icon" aria-hidden="true"></i>
                    </div>
                    <p class="kpi-card__value">4</p>
                    <div class="kpi-card__meta">Applications saved and not yet submitted</div>
                </article>
            </section>

            <section class="panel" aria-labelledby="draftApplicationsTitle">
                <div class="panel__header">
                    <div>
                        <h1 class="panel__title" id="draftApplicationsTitle">Draft Applications</h1>
                        <p class="text-muted">Continue editing applications that have not been submitted.</p>
                    </div>
                </div>

                <div class="table-wrap">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th scope="col">Draft ID</th>
                                <th scope="col">Last Saved</th>
                                <th scope="col">Borrower</th>
                                <th scope="col">Borrower Type</th>
                                <th scope="col">Application Type</th>
                                <th scope="col">Branch</th>
                                <th scope="col">Requested Amount</th>
                                <th scope="col">Current Step</th>
                                <th scope="col">Completion</th>
                                <th scope="col" class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>DRF-JKT-202609-0148</strong></td>
                                <td>30 Sep 2026, 10:42</td>
                                <td>PT Sinar Abadi</td>
                                <td>Corporate</td>
                                <td>Working Capital</td>
                                <td>Jakarta</td>
                                <td>Rp 2.500.000.000</td>
                                <td>Borrower Information</td>
                                <td><strong>65%</strong></td>
                                <td class="text-right"><a class="table-link" href="<?= base_url('new-app') ?>?draft=DRF-JKT-202609-0148">Edit</a></td>
                            </tr>
                            <tr>
                                <td><strong>DRF-BDG-202609-0142</strong></td>
                                <td>29 Sep 2026, 15:18</td>
                                <td>CV Maju Bersama</td>
                                <td>SME</td>
                                <td>Investment</td>
                                <td>Bandung</td>
                                <td>Rp 850.000.000</td>
                                <td>Collateral</td>
                                <td><strong>42%</strong></td>
                                <td class="text-right"><a class="table-link" href="<?= base_url('new-app') ?>?draft=DRF-BDG-202609-0142">Edit</a></td>
                            </tr>
                            <tr>
                                <td><strong>DRF-SBY-202609-0137</strong></td>
                                <td>28 Sep 2026, 09:05</td>
                                <td>PT Cipta Niaga</td>
                                <td>Corporate</td>
                                <td>Working Capital</td>
                                <td>Surabaya</td>
                                <td>Rp 1.200.000.000</td>
                                <td>Financial Information</td>
                                <td><strong>58%</strong></td>
                                <td class="text-right"><a class="table-link" href="<?= base_url('new-app') ?>?draft=DRF-SBY-202609-0137">Edit</a></td>
                            </tr>
                            <tr>
                                <td><strong>DRF-JKT-202609-0129</strong></td>
                                <td>26 Sep 2026, 13:30</td>
                                <td>PT Karya Utama</td>
                                <td>Corporate</td>
                                <td>Investment</td>
                                <td>Jakarta</td>
                                <td>Rp 3.000.000.000</td>
                                <td>Application Details</td>
                                <td><strong>25%</strong></td>
                                <td class="text-right"><a class="table-link" href="<?= base_url('new-app') ?>?draft=DRF-JKT-202609-0129">Edit</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <footer class="table-footer">
                    <p>Showing <strong>1-4</strong> of <strong>4</strong> draft applications</p>
                    <nav class="table-pagination" aria-label="Draft applications pagination">
                        <button class="btn btn-secondary table-pagination__button" type="button" aria-label="Previous page" disabled>
                            <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                        </button>
                        <button class="btn btn-dark table-pagination__button" type="button" aria-current="page">1</button>
                        <button class="btn btn-secondary table-pagination__button" type="button" aria-label="Next page" disabled>
                            <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                        </button>
                    </nav>
                    <label class="table-footer__rows">
                        <span>Rows per page</span>
                        <select class="select" name="per_page" aria-label="Rows per page">
                            <option selected>10</option>
                            <option>25</option>
                            <option>50</option>
                        </select>
                    </label>
                </footer>
            </section>
        </div>
    </main>

    <script src="<?= base_url('assets/js/sidebar.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>

</html>
