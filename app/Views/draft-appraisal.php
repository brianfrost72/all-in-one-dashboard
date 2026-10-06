<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Draft Appraisal &ndash; Aggre Capital Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/sidebar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">
</head>
<body>
    <?= $this->include('layouts/sidebar') ?>

    <main class="main-section">
        <header class="top-header">
            <div class="top-header__inner">
                <nav class="top-header__breadcrumb" aria-label="Breadcrumb">
                    <a href="<?= base_url('/') ?>">Dashboard</a>
                    <span class="top-header__breadcrumb-separator">/</span>
                    <span class="top-header__breadcrumb-current">Collateral Appraisal</span>
                    <span class="top-header__breadcrumb-separator">/</span>
                    <span class="top-header__breadcrumb-current">Draft Appraisal</span>
                </nav>
                <form class="top-header__search" role="search" onsubmit="return false">
                    <i class="fa-solid fa-magnifying-glass top-header__search-icon" aria-hidden="true"></i>
                    <input class="top-header__search-input" type="search" placeholder="Search draft, application, borrower, or collateral..." aria-label="Search draft appraisal">
                </form>
                <div class="top-header__actions">
                    <a class="top-header__filter" href="<?= base_url('appraisal-list') ?>" style="text-decoration:none">
                        <i class="fa-solid fa-list" aria-hidden="true"></i>
                        <span class="top-header__filter-label">Appraisal Task List</span>
                    </a>
                    <button class="top-header__notification" id="notificationTrigger" type="button" aria-label="Open notifications" aria-haspopup="dialog" aria-controls="notificationModal" aria-expanded="false">
                        <i class="fa-regular fa-bell" aria-hidden="true"></i>
                        <span class="top-header__notification-badge" id="notificationHeaderBadge">5</span>
                    </button>
                </div>
            </div>
        </header>

        <div class="main-container">
            <section class="kpi-row" aria-label="Draft appraisal metrics" style="grid-template-columns: minmax(240px, 320px); height:auto; min-height:110px">
                <article class="kpi-card">
                    <div class="kpi-card__head">
                        <span class="kpi-card__label">Total Draft Appraisals</span>
                        <i class="fa-regular fa-file-lines kpi-card__trend-icon" aria-hidden="true"></i>
                    </div>
                    <p class="kpi-card__value">3</p>
                    <div class="kpi-card__meta">Appraisal tasks saved and not yet submitted</div>
                </article>
            </section>

            <section class="panel" aria-labelledby="draftAppraisalsTitle">
                <div class="panel__header">
                    <div>
                        <h1 class="panel__title" id="draftAppraisalsTitle">Draft Appraisal</h1>
                        <p class="text-muted">Continue appraisal work saved before submission.</p>
                    </div>
                </div>

                <div class="table-wrap">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th scope="col">Draft ID</th>
                                <th scope="col">Last Saved</th>
                                <th scope="col">Application</th>
                                <th scope="col">Borrower</th>
                                <th scope="col">Collateral</th>
                                <th scope="col">Branch</th>
                                <th scope="col">Current Step</th>
                                <th scope="col">Completion</th>
                                <th scope="col" class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>APD-JKT-202610-0024</strong></td>
                                <td>05 Oct 2026, 10:42</td>
                                <td>LOS-JKT-202610-0184</td>
                                <td>PT Sinar Abadi</td>
                                <td>Office Building, Sudirman</td>
                                <td>Jakarta</td>
                                <td>Asset Appraisal Summary</td>
                                <td><strong>60%</strong></td>
                                <td class="text-right"><a class="table-link" href="<?= base_url('appraisal-task') ?>?application=LOS-JKT-202610-0184&amp;borrower=PT%20Sinar%20Abadi&amp;collateral=Office%20Building%2C%20Sudirman&amp;branch=Jakarta">Continue</a></td>
                            </tr>
                            <tr>
                                <td><strong>APD-BDG-202610-0019</strong></td>
                                <td>04 Oct 2026, 15:18</td>
                                <td>LOS-BDG-202610-0172</td>
                                <td>CV Maju Bersama</td>
                                <td>Warehouse, Gedebage</td>
                                <td>Bandung</td>
                                <td>Site Visit</td>
                                <td><strong>35%</strong></td>
                                <td class="text-right"><a class="table-link" href="<?= base_url('appraisal-task') ?>?application=LOS-BDG-202610-0172&amp;borrower=CV%20Maju%20Bersama&amp;collateral=Warehouse%2C%20Gedebage&amp;branch=Bandung">Continue</a></td>
                            </tr>
                            <tr>
                                <td><strong>APD-SBY-202610-0013</strong></td>
                                <td>02 Oct 2026, 09:05</td>
                                <td>LOS-SBY-202610-0161</td>
                                <td>PT Cipta Niaga</td>
                                <td>Industrial Land, Rungkut</td>
                                <td>Surabaya</td>
                                <td>Assignment Confirmation</td>
                                <td><strong>15%</strong></td>
                                <td class="text-right"><a class="table-link" href="<?= base_url('appraisal-task') ?>?application=LOS-SBY-202610-0161&amp;borrower=PT%20Cipta%20Niaga&amp;collateral=Industrial%20Land%2C%20Rungkut&amp;branch=Surabaya">Continue</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <footer class="table-footer">
                    <p>Showing <strong>1-3</strong> of <strong>3</strong> draft appraisals</p>
                    <nav class="table-pagination" aria-label="Draft appraisal pagination">
                        <button class="btn btn-secondary table-pagination__button" type="button" aria-label="Previous page" disabled><i class="fa-solid fa-chevron-left" aria-hidden="true"></i></button>
                        <button class="btn btn-dark table-pagination__button" type="button" aria-current="page">1</button>
                        <button class="btn btn-secondary table-pagination__button" type="button" aria-label="Next page" disabled><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></button>
                    </nav>
                    <label class="table-footer__rows">
                        <span>Rows per page</span>
                        <select class="select" name="per_page" aria-label="Rows per page">
                            <option selected>10</option><option>25</option><option>50</option>
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
