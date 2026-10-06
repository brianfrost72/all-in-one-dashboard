<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>New Application &ndash; Aggre Capital Dashboard</title>

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


    <!-- Self-contained image preview viewer. Intentionally isolated from main.css. -->
    <style>
        .aggre-image-viewer,
        .aggre-image-viewer * {
            box-sizing: border-box;
        }

        .aggre-image-viewer {
            position: fixed !important;
            inset: 0 !important;
            z-index: 2147483000 !important;
            display: none;
            align-items: center;
            justify-content: center;
            width: 100vw !important;
            height: 100dvh !important;
            padding: 24px;
            isolation: isolate;
        }

        .aggre-image-viewer.is-open {
            display: flex !important;
        }

        .aggre-image-viewer__backdrop {
            position: absolute;
            inset: 0;
            z-index: 0;
            border: 0;
            margin: 0;
            padding: 0;
            background: rgba(7, 11, 9, 0.78);
            backdrop-filter: blur(3px);
            -webkit-backdrop-filter: blur(3px);
            cursor: zoom-out;
        }

        .aggre-image-viewer__panel {
            position: relative;
            z-index: 1;
            width: min(94vw, 1440px);
            height: min(92dvh, 920px);
            min-width: 0;
            min-height: 0;
            display: grid;
            grid-template-rows: auto minmax(0, 1fr) auto;
            overflow: hidden;
            border: 1px solid #dfe4dc;
            border-radius: 14px;
            background: #ffffff;
            box-shadow: 0 28px 90px rgba(0, 0, 0, 0.38);
        }

        .aggre-image-viewer__header {
            min-height: 62px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            border-bottom: 1px solid #e5e7e2;
            background: #ffffff;
        }

        .aggre-image-viewer__title {
            min-width: 0;
        }

        .aggre-image-viewer__eyebrow {
            display: block;
            margin-bottom: 2px;
            color: #58705f;
            font-size: 10px;
            line-height: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .aggre-image-viewer__title h2 {
            margin: 0;
            max-width: min(72vw, 1100px);
            overflow: hidden;
            color: #141613;
            font-family: Inter, sans-serif;
            font-size: 15px;
            line-height: 20px;
            font-weight: 700;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .aggre-image-viewer__close {
            width: 36px;
            height: 36px;
            flex: 0 0 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e5e7e2;
            border-radius: 9px;
            background: #f6f7f4;
            color: #141613;
            cursor: pointer;
            font-size: 16px;
        }

        .aggre-image-viewer__close:hover {
            background: #eef1ea;
        }

        .aggre-image-viewer__stage {
            position: relative;
            min-width: 0;
            min-height: 0;
            overflow: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background:
                linear-gradient(45deg, #f3f4f1 25%, transparent 25%),
                linear-gradient(-45deg, #f3f4f1 25%, transparent 25%),
                linear-gradient(45deg, transparent 75%, #f3f4f1 75%),
                linear-gradient(-45deg, transparent 75%, #f3f4f1 75%),
                #fafbf9;
            background-size: 24px 24px;
            background-position: 0 0, 0 12px, 12px -12px, -12px 0;
        }

        .aggre-image-viewer__image {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            width: auto !important;
            height: auto !important;
            max-width: 100% !important;
            max-height: 100% !important;
            object-fit: contain !important;
            object-position: center center !important;
            border-radius: 6px;
            background: #ffffff;
            box-shadow: 0 8px 30px rgba(0, 0, 0, .14);
        }

        .aggre-image-viewer__status {
            position: absolute;
            inset: 0;
            z-index: 2;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 24px;
            color: #4b5563;
            background: #fafbf9;
            font-family: Inter, sans-serif;
            font-size: 13px;
            text-align: center;
        }

        .aggre-image-viewer.is-loading .aggre-image-viewer__status,
        .aggre-image-viewer.has-error .aggre-image-viewer__status {
            display: flex;
        }

        .aggre-image-viewer.is-loading .aggre-image-viewer__image,
        .aggre-image-viewer.has-error .aggre-image-viewer__image {
            visibility: hidden !important;
        }

        .aggre-image-viewer.has-error .aggre-image-viewer__status {
            color: #b42318;
        }

        .aggre-image-viewer__footer {
            min-height: 42px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            border-top: 1px solid #e5e7e2;
            background: #ffffff;
            color: #73786f;
            font-family: Inter, sans-serif;
            font-size: 9px;
            line-height: 13px;
        }

        body.aggre-image-viewer-open {
            overflow: hidden !important;
        }

        @media (max-width: 720px) {
            .aggre-image-viewer {
                padding: 10px;
            }

            .aggre-image-viewer__panel {
                width: calc(100vw - 20px);
                height: calc(100dvh - 20px);
                border-radius: 10px;
            }

            .aggre-image-viewer__stage {
                padding: 10px;
            }

            .aggre-image-viewer__footer {
                align-items: flex-start;
                flex-direction: column;
                gap: 2px;
            }
        }
    </style>

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
                    <span class="top-header__breadcrumb-current">New Application</span>
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

        <div class="main-container new-application-page">

            <!-- =====================================================
         APPLICATION PROGRESS
         ===================================================== -->
            <section
                class="new-app-progress-card"
                aria-label="New application progress">

                <div class="new-app-progress-scroll" id="newAppProgressScroll">

                    <nav class="new-app-progress-track" id="newAppProgress">

                        <!-- STEP 1 -->
                        <a
                            href="#applicationData"
                            class="new-app-progress-step is-active"
                            data-step="1">

                            <span class="new-app-progress-step__number">
                                1
                            </span>

                            <span class="new-app-progress-step__label">
                                Application Data
                            </span>
                        </a>

                        <span class="new-app-progress-line"></span>


                        <!-- STEP 2 -->
                        <a
                            href="#docUpload"
                            class="new-app-progress-step"
                            data-step="2">

                            <span class="new-app-progress-step__number">
                                2
                            </span>

                            <span class="new-app-progress-step__label">
                                Document Upload
                            </span>
                        </a>

                        <span class="new-app-progress-line"></span>

                        <!-- STEP 3 -->
                        <a
                            href="#borrowerData"
                            class="new-app-progress-step"
                            data-step="3">

                            <span class="new-app-progress-step__number">
                                3
                            </span>

                            <span class="new-app-progress-step__label">
                                Borrower Data
                            </span>
                        </a>

                        <span class="new-app-progress-line"></span>


                        <!-- STEP 4 -->
                        <a
                            href="#employmentBusiness"
                            class="new-app-progress-step"
                            data-step="4">

                            <span class="new-app-progress-step__number">
                                4
                            </span>

                            <span class="new-app-progress-step__label">
                                Employment / Business Information
                            </span>
                        </a>

                        <span class="new-app-progress-line"></span>


                        <!-- STEP 5 -->
                        <a
                            href="#spouseManagement"
                            class="new-app-progress-step"
                            data-step="5">

                            <span class="new-app-progress-step__number">
                                5
                            </span>

                            <span class="new-app-progress-step__label">
                                Spouse / Management &amp; Shareholder
                            </span>
                        </a>

                        <span class="new-app-progress-line"></span>


                        <!-- STEP 6 -->
                        <a
                            href="#collateral"
                            class="new-app-progress-step"
                            data-step="6">

                            <span class="new-app-progress-step__number">
                                6
                            </span>

                            <span class="new-app-progress-step__label">
                                Collateral &amp; Collateral Owner
                            </span>
                        </a>

                        <span class="new-app-progress-line"></span>


                        <!-- STEP 7 -->
                        <a
                            href="#repayment"
                            class="new-app-progress-step"
                            data-step="7">

                            <span class="new-app-progress-step__number">
                                7
                            </span>

                            <span class="new-app-progress-step__label">
                                Repayment Information
                            </span>
                        </a>

                        <span class="new-app-progress-line"></span>


                        <!-- STEP 8 -->
                        <a
                            href="#reviewSubmit"
                            class="new-app-progress-step"
                            data-step="8">

                            <span class="new-app-progress-step__number">
                                8
                            </span>

                            <span class="new-app-progress-step__label">
                                Review &amp; Submit
                            </span>
                        </a>

                    </nav>

                </div>

            </section>



            <!-- =====================================================
         PAGE CONTENT
         Only one page displayed at a time
         ===================================================== -->
            <div class="new-app-pages" id="newAppPages">


                <!-- =============================================
             STEP 1 - APPLICATION DATA
             ============================================= -->
                <section
                    class="new-app-page is-active"
                    id="applicationData"
                    data-step="1">

                    <header class="new-app-page-header">
                        <h1>Application Data</h1>

                        <p>
                            Define credit application parameters, borrower type,
                            branch, reference source, and takeover information.
                        </p>
                    </header>


                    <div class="new-app-application-stack">

                        <!-- =====================================================
         APPLICATION PARAMETERS
         ===================================================== -->
                        <section class="new-app-form-card application-parameters-card">

                            <h2 class="new-app-form-card__title">
                                Application Parameters
                            </h2>

                            <div class="application-parameters-grid">

                                <!-- =============================================
                 APPLICATION TYPE
                 ============================================= -->
                                <div class="new-app-field">

                                    <label class="new-app-field__label">
                                        Application Type
                                        <span>*</span>
                                    </label>

                                    <div class="new-app-option-grid">

                                        <label class="new-app-option is-selected">
                                            <input
                                                type="radio"
                                                name="application_type"
                                                value="new"
                                                checked>

                                            <span class="new-app-option__radio"></span>

                                            <span class="new-app-option__text">
                                                New Facility
                                            </span>
                                        </label>


                                        <label class="new-app-option">
                                            <input
                                                type="radio"
                                                name="application_type"
                                                value="existing">

                                            <span class="new-app-option__radio"></span>

                                            <span class="new-app-option__text">
                                                Existing Facility
                                            </span>
                                        </label>

                                    </div>

                                </div>


                                <!-- =============================================
                 BORROWER TYPE
                 ============================================= -->
                                <div class="new-app-field">

                                    <label class="new-app-field__label">
                                        Borrower Type
                                        <span>*</span>
                                    </label>

                                    <div class="new-app-option-grid">

                                        <label class="new-app-option">
                                            <input
                                                type="radio"
                                                name="borrower_type"
                                                value="individual">

                                            <span class="new-app-option__radio"></span>

                                            <span class="new-app-option__text">
                                                Individual
                                            </span>
                                        </label>


                                        <label class="new-app-option is-selected">
                                            <input
                                                type="radio"
                                                name="borrower_type"
                                                value="business"
                                                checked>

                                            <span class="new-app-option__radio"></span>

                                            <span class="new-app-option__text">
                                                Business Entity
                                            </span>
                                        </label>

                                    </div>

                                </div>


                                <!-- =============================================
                 COLLATERAL STATUS
                 ============================================= -->
                                <div class="new-app-field">

                                    <label class="new-app-field__label">
                                        Collateral Status
                                        <span>*</span>
                                    </label>

                                    <div class="new-app-option-grid">

                                        <label class="new-app-option is-selected">
                                            <input
                                                type="radio"
                                                name="collateral_status"
                                                value="on_hand"
                                                checked>

                                            <span class="new-app-option__radio"></span>

                                            <span class="new-app-option__text">
                                                On Hand
                                            </span>
                                        </label>


                                        <label class="new-app-option">
                                            <input
                                                type="radio"
                                                name="collateral_status"
                                                value="take_over">

                                            <span class="new-app-option__radio"></span>

                                            <span class="new-app-option__text">
                                                Take Over
                                            </span>
                                        </label>

                                    </div>

                                </div>


                                <!-- =============================================
                 BRANCH
                 ============================================= -->
                                <div class="new-app-field">

                                    <label
                                        for="applicationBranch"
                                        class="new-app-field__label">
                                        Branch
                                        <span>*</span>
                                    </label>

                                    <select
                                        id="applicationBranch"
                                        class="new-app-control">

                                        <option>Jakarta / Head Office</option>
                                        <option>Bandung</option>
                                        <option>Surabaya</option>
                                        <option>Medan</option>

                                    </select>

                                </div>


                                <!-- =============================================
                 REFERENCE SOURCE
                 ============================================= -->
                                <div class="new-app-field">

                                    <label class="new-app-field__label">
                                        Reference Source
                                        <span>*</span>
                                    </label>

                                    <div class="new-app-option-grid">

                                        <label class="new-app-option is-selected">
                                            <input
                                                type="radio"
                                                name="reference_source"
                                                value="agent"
                                                checked>

                                            <span class="new-app-option__radio"></span>

                                            <span class="new-app-option__text">
                                                Agent
                                            </span>
                                        </label>


                                        <label class="new-app-option">
                                            <input
                                                type="radio"
                                                name="reference_source"
                                                value="non_agent">

                                            <span class="new-app-option__radio"></span>

                                            <span class="new-app-option__text">
                                                Non Agent
                                            </span>
                                        </label>

                                    </div>

                                </div>


                                <!-- =============================================
                 AGENT
                 ============================================= -->
                                <div class="new-app-field">

                                    <label
                                        for="applicationAgent"
                                        class="new-app-field__label">
                                        Agent Name
                                        <span>*</span>
                                    </label>

                                    <select
                                        id="applicationAgent"
                                        class="new-app-control">

                                        <option>Sutrisno Wijaya</option>
                                        <option>Andi Gunawan</option>
                                        <option>PT Mitra Finansial</option>

                                    </select>

                                </div>


                                <!-- =============================================
                 MARKETING
                 ============================================= -->
                                <div class="new-app-field">

                                    <label class="new-app-field__label">
                                        Marketing Office / Officer
                                    </label>

                                    <div class="new-app-control new-app-control--readonly">

                                        <span>Roni Pratama</span>

                                        <span class="new-app-autofill-badge">
                                            Auto-filled
                                        </span>

                                    </div>

                                </div>


                                <!-- =============================================
                 ACCOUNT MANAGER
                 ============================================= -->
                                <div class="new-app-field">

                                    <label
                                        for="accountManager"
                                        class="new-app-field__label">
                                        Account Manager
                                        <span>*</span>
                                    </label>

                                    <select
                                        id="accountManager"
                                        class="new-app-control">

                                        <option value="">
                                            Select Account Manager...
                                        </option>

                                        <option>Sarah Wijaya</option>
                                        <option>Ahmad Fauzi</option>
                                        <option>Hendra Gunawan</option>

                                    </select>

                                </div>


                                <!-- =============================================
                 BUSINESS HEAD
                 ============================================= -->
                                <div class="new-app-field new-app-field--full">

                                    <label class="new-app-field__label">
                                        Business Head
                                    </label>

                                    <div class="new-app-control new-app-control--disabled">
                                        Gunawan Wibowo (Corporate Banking Head)
                                    </div>

                                </div>

                            </div>

                        </section>


                        <!-- =====================================================
         EXISTING FACILITY PARAMETERS
         ===================================================== -->
                        <section
                            class="new-app-form-card existing-facility-card"
                            id="existingFacilityParameters"
                            hidden>

                            <div class="existing-facility-header">

                                <div>
                                    <h2 class="new-app-form-card__title">
                                        Existing Facility Parameters
                                    </h2>

                                    <p>
                                        Select the borrower's existing facility and review
                                        its current terms before defining the requested change.
                                    </p>
                                </div>

                                <span class="existing-facility-badge">
                                    Existing Facility
                                </span>

                            </div>


                            <div class="existing-facility-grid">


                                <!-- Facility lookup -->
                                <div class="new-app-field">

                                    <label
                                        for="existingFacilityNumber"
                                        class="new-app-field__label">

                                        Existing Facility / Contract No.
                                        <span>*</span>

                                    </label>

                                    <div class="existing-facility-search">

                                        <i class="fa-solid fa-magnifying-glass"></i>

                                        <select
                                            id="existingFacilityNumber"
                                            class="new-app-control">

                                            <option value="">
                                                Search existing facility...
                                            </option>

                                            <option>
                                                CTR-JKT-2025-0048 — Working Capital
                                            </option>

                                            <option>
                                                CTR-JKT-2024-0116 — Investment Loan
                                            </option>

                                        </select>

                                    </div>

                                </div>


                                <!-- Facility type -->
                                <div class="new-app-field">

                                    <label class="new-app-field__label">
                                        Existing Product / Facility Type
                                    </label>

                                    <div class="new-app-control new-app-control--readonly">
                                        Working Capital Loan
                                    </div>

                                </div>


                                <!-- Original amount -->
                                <div class="new-app-field">

                                    <label class="new-app-field__label">
                                        Original Approved Amount
                                    </label>

                                    <div class="new-app-control new-app-control--readonly">
                                        Rp 2,000,000,000
                                    </div>

                                </div>


                                <!-- Outstanding -->
                                <div class="new-app-field">

                                    <label class="new-app-field__label">
                                        Current Outstanding
                                    </label>

                                    <div class="new-app-control new-app-control--readonly">
                                        Rp 1,250,000,000
                                    </div>

                                </div>


                                <!-- Start date -->
                                <div class="new-app-field">

                                    <label class="new-app-field__label">
                                        Facility Start Date
                                    </label>

                                    <div class="new-app-control new-app-control--readonly">
                                        12 Jan 2025
                                    </div>

                                </div>


                                <!-- Maturity -->
                                <div class="new-app-field">

                                    <label class="new-app-field__label">
                                        Maturity Date
                                    </label>

                                    <div class="new-app-control new-app-control--readonly">
                                        12 Jan 2028
                                    </div>

                                </div>


                                <!-- Interest -->
                                <div class="new-app-field">

                                    <label class="new-app-field__label">
                                        Current Interest Rate
                                    </label>

                                    <div class="new-app-control new-app-control--readonly">
                                        12.50% p.a.
                                    </div>

                                </div>


                                <!-- Installment -->
                                <div class="new-app-field">

                                    <label class="new-app-field__label">
                                        Current Monthly Installment
                                    </label>

                                    <div class="new-app-control new-app-control--readonly">
                                        Rp 46,800,000
                                    </div>

                                </div>


                                <!-- Payment status -->
                                <div class="new-app-field">

                                    <label class="new-app-field__label">
                                        Payment Status
                                    </label>

                                    <div class="existing-facility-status">
                                        <i class="fa-solid fa-circle-check"></i>
                                        Current / Performing
                                    </div>

                                </div>


                                <!-- DPD -->
                                <div class="new-app-field">

                                    <label class="new-app-field__label">
                                        Current DPD
                                    </label>

                                    <div class="new-app-control new-app-control--readonly">
                                        0 Days
                                    </div>

                                </div>


                                <!-- Request type -->
                                <div class="new-app-field">

                                    <label
                                        for="existingRequestType"
                                        class="new-app-field__label">

                                        Request Type
                                        <span>*</span>

                                    </label>

                                    <select
                                        id="existingRequestType"
                                        class="new-app-control">

                                        <option value="">
                                            Select request type...
                                        </option>

                                        <option>Top Up</option>
                                        <option>Limit Increase</option>
                                        <option>Renewal</option>
                                        <option>Extension</option>
                                        <option>Restructure</option>
                                        <option>Refinancing</option>
                                        <option>Amendment</option>

                                    </select>

                                </div>


                                <!-- Additional amount -->
                                <div class="new-app-field">

                                    <label
                                        for="additionalAmount"
                                        class="new-app-field__label">

                                        Requested Additional Amount

                                    </label>

                                    <div class="new-app-money-control">

                                        <span>Rp</span>

                                        <input
                                            id="additionalAmount"
                                            type="text"
                                            placeholder="0">

                                    </div>

                                </div>


                                <!-- Notes -->
                                <div class="new-app-field new-app-field--full">

                                    <label
                                        for="existingFacilityReason"
                                        class="new-app-field__label">

                                        Request Reason / Notes
                                        <span>*</span>

                                    </label>

                                    <textarea
                                        id="existingFacilityReason"
                                        class="new-app-textarea"
                                        placeholder="Describe the reason for modifying the existing facility..."></textarea>

                                </div>

                            </div>

                        </section>

                    </div>


                    <footer class="new-app-page-actions">

                        <div class="new-app-page-actions__info">
                            Step 1 of 8 — Application Data
                        </div>

                        <div class="new-app-page-actions__buttons">

                            <div class="new-app-draft-control">
                                <button
                                    type="button"
                                    class="new-app-btn new-app-btn--secondary new-app-save-draft"
                                    data-save-draft="applicationData">
                                    <i class="fa-regular fa-floppy-disk" aria-hidden="true"></i>
                                    Save as Draft
                                </button>

                                <span class="new-app-draft-time" data-draft-time="applicationData">
                                    <i class="fa-regular fa-clock" aria-hidden="true"></i>
                                    <span>Created: — &middot; Last saved: —</span>
                                </span>
                            </div>

<a
                                href="#docUpload"
                                class="new-app-btn new-app-btn--primary">
                                Continue to Documents
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                        </div>

                    </footer>

                </section>



                <!-- =============================================
             STEP 2 - DOCUMENT UPLOAD
             ============================================= -->
                <section
                    class="new-app-page"
                    id="docUpload"
                    data-step="2"
                    hidden>

                    <header class="new-app-page-header doc-upload-header">

                        <h1 class="doc-upload-header__title">
                            Document Upload
                        </h1>

                        <p class="doc-upload-header__description">
                            Upload documents according to the application conditions.
                            The system can classify files and extract data to help pre-fill information,
                            while required documents must still follow the BRD checklist.
                        </p>

                    </header>

                    <!-- =====================================================
     DOCUMENT UPLOAD - OCR INFO BANNER
     ===================================================== -->
                    <div class="doc-upload-info">

                        <div class="doc-upload-info__icon" aria-hidden="true">
                            <i class="fa-regular fa-lightbulb"></i>
                        </div>

                        <div class="doc-upload-info__content">

                            <strong class="doc-upload-info__title">
                                Save time with automatic document extraction
                            </strong>

                            <p class="doc-upload-info__description">
                                Uploaded documents will be processed to pre-fill borrower,
                                business, collateral, and financial information.
                                You can review and correct the extracted data before submission.
                            </p>

                        </div>

                    </div>

                    <!-- =====================================================
                         DOCUMENT CHECKLIST
                         Dynamic by borrower/application conditions.
                         ===================================================== -->
                    <section class="doc-checklist-shell" aria-labelledby="documentChecklistTitle">

                        <div class="doc-checklist-overview">
                            <div class="doc-checklist-overview__copy">
                                <span class="doc-checklist-overview__eyebrow">Document Checklist</span>
                                <h2 id="documentChecklistTitle">Documents required for this application</h2>
                                <p>
                                    Accepted formats: PDF, JPG, JPEG, PNG. Maximum 10 MB per file.
                                    The checklist updates automatically based on borrower type and application conditions.
                                    Replacing a file keeps its previous version during the current session.
                                </p>
                            </div>

                            <div class="doc-checklist-stats" aria-label="Document upload summary">
                                <div class="doc-checklist-stat">
                                    <span>Required</span>
                                    <strong id="docRequiredCount">0</strong>
                                </div>
                                <div class="doc-checklist-stat doc-checklist-stat--success">
                                    <span>Uploaded</span>
                                    <strong id="docUploadedCount">0</strong>
                                </div>
                                <div class="doc-checklist-stat doc-checklist-stat--danger">
                                    <span>Missing</span>
                                    <strong id="docMissingCount">0</strong>
                                </div>
                                <div class="doc-checklist-stat doc-checklist-stat--warning">
                                    <span>Conditional</span>
                                    <strong id="docConditionalCount">0</strong>
                                </div>
                            </div>
                        </div>

                        <div class="doc-checklist-legend" aria-label="Document status legend">
                            <span><i class="fa-solid fa-circle doc-checklist-legend__dot doc-checklist-legend__dot--required"></i> Required</span>
                            <span><i class="fa-solid fa-circle doc-checklist-legend__dot doc-checklist-legend__dot--conditional"></i> Conditional</span>
                            <span><i class="fa-solid fa-circle doc-checklist-legend__dot doc-checklist-legend__dot--optional"></i> Optional</span>
                            <span><i class="fa-solid fa-circle-check"></i> Uploaded documents are ready for OCR</span>
                        </div>

                        <div class="doc-checklist-message" id="docUploadMessage" role="status" hidden></div>

                        <div class="doc-checklist-groups" id="docUploadGroups"></div>

                    </section>

                    <footer class="new-app-page-actions">

                        <div class="new-app-page-actions__info">
                            Step 2 of 8 — Document Upload
                        </div>

                        <div class="new-app-page-actions__buttons">

                            <div class="new-app-draft-control">
                                <button
                                    type="button"
                                    class="new-app-btn new-app-btn--secondary new-app-save-draft"
                                    data-save-draft="docUpload">
                                    <i class="fa-regular fa-floppy-disk" aria-hidden="true"></i>
                                    Save as Draft
                                </button>

                                <span class="new-app-draft-time" data-draft-time="docUpload">
                                    <i class="fa-regular fa-clock" aria-hidden="true"></i>
                                    <span>Created: — &middot; Last saved: —</span>
                                </span>
                            </div>


                            <a
                                href="#applicationData"
                                class="new-app-btn new-app-btn--secondary">
                                <i class="fa-solid fa-arrow-left"></i>
                                Previous
                            </a>

                            <a
                                href="#borrowerData"
                                class="new-app-btn new-app-btn--primary">
                                Continue to Borrower Data
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                        </div>

                    </footer>

                </section>

                <!-- =============================================
             STEP 3 - BORROWER DATA
             OCR results are reviewed directly here.
             ============================================= -->
                <section
                    class="new-app-page"
                    id="borrowerData"
                    data-step="3"
                    hidden>

                    <header class="new-app-page-header borrower-data-header">
                        <div>
                            <h1>Borrower Data</h1>
                            <p>
                                OCR results from uploaded documents are pre-filled here automatically.
                                Review, correct, and complete the borrower information before continuing.
                            </p>
                        </div>

                        <div class="borrower-data-header__badges">
                            <span class="borrower-type-badge" id="borrowerTypeBadge">
                                Business Entity
                            </span>
                            <span class="borrower-ocr-badge">
                                <i class="fa-solid fa-wand-magic-sparkles" aria-hidden="true"></i>
                                OCR Auto-filled
                            </span>
                        </div>
                    </header>

                    <div class="info-banner">
                        <i class="fa-solid fa-circle-info" aria-hidden="true"></i>
                        <div>
                            <strong>Document OCR is processed automatically</strong>
                            <p>
                                Values detected from Personal Data and Business Legality uploads are inserted into the fields below.
                                Fields can still be edited when the OCR result needs correction.
                            </p>
                        </div>
                    </div>

                    <!-- =====================================================
                         A. INDIVIDUAL BORROWER - 19 FIELDS
                         Visible only when borrower_type = individual
                         ===================================================== -->
                    <section class="borrower-template" id="borrowerIndividualForm" data-borrower-template="individual" hidden>
                        <div class="borrower-template__header">
                            <div>
                                <span class="borrower-template__eyebrow">A. Individual Borrower</span>
                                <h2>Personal Borrower Information</h2>
                                <p>19 fields based on the Individual Borrower data specification.</p>
                            </div>
                            <span class="borrower-template__count">19 Fields</span>
                        </div>

                        <div class="borrower-form-grid">
                            <div class="borrower-field borrower-field--span-2">
                                <label for="individualFullName">1. Full Name (as per ID Card) <span>*</span></label>
                                <input id="individualFullName" name="individual_full_name" type="text" maxlength="100" required placeholder="FULL NAME AS PER ID CARD" data-ocr-field="full_name">
                                <small>Capital letters, maximum 100 characters.</small>
                            </div>

                            <div class="borrower-field">
                                <label for="individualNik">2. NIK <span>*</span></label>
                                <input id="individualNik" name="individual_nik" type="text" inputmode="numeric" maxlength="16" pattern="[0-9]{16}" required placeholder="16-digit NIK" data-ocr-field="nik">
                                <small>16 digits. Duplicate active applications and rejection history should be checked.</small>
                            </div>

                            <div class="borrower-field">
                                <label for="individualBirthPlace">3. Place of Birth <span>*</span></label>
                                <input id="individualBirthPlace" name="individual_birth_place" type="text" required placeholder="Place of birth" data-ocr-field="birth_place">
                            </div>

                            <div class="borrower-field">
                                <label for="individualBirthDate">4. Date of Birth <span>*</span></label>
                                <input id="individualBirthDate" name="individual_birth_date" type="date" required data-ocr-field="birth_date">
                                <small>Age is calculated automatically; minimum age 21 and age + tenor follows master maximum.</small>
                            </div>

                            <div class="borrower-field">
                                <label for="individualGender">5. Gender <span>*</span></label>
                                <select id="individualGender" name="individual_gender" required data-ocr-field="gender">
                                    <option value="">Select gender...</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                            <div class="borrower-field">
                                <label for="individualMaritalStatus">6. Marital Status <span>*</span></label>
                                <select id="individualMaritalStatus" name="individual_marital_status" required data-ocr-field="marital_status">
                                    <option value="">Select marital status...</option>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="divorced">Divorced</option>
                                    <option value="widowed">Widowed</option>
                                </select>
                                <small>If Married, spouse data becomes required.</small>
                            </div>

                            <div class="borrower-field">
                                <label for="individualEducation">7. Highest Education</label>
                                <select id="individualEducation" name="individual_education">
                                    <option value="">Select education...</option>
                                    <option>SD</option><option>SMP</option><option>SMA</option><option>D3</option><option>S1</option><option>S2</option><option>S3</option>
                                </select>
                            </div>

                            <div class="borrower-field">
                                <label for="individualDependents">8. Number of Dependents <span>*</span></label>
                                <input id="individualDependents" name="individual_dependents" type="number" min="0" max="20" required placeholder="0 - 20">
                            </div>

                            <div class="borrower-field">
                                <label for="individualMotherName">9. Mother's Maiden Name <span>*</span></label>
                                <input id="individualMotherName" name="individual_mother_name" type="text" required placeholder="Mother's maiden name" data-ocr-field="mother_name">
                                <small>Masked for roles other than Marketing &amp; CA.</small>
                            </div>

                            <div class="borrower-field">
                                <label for="individualNpwp">10. Personal NPWP <span>*</span></label>
                                <input id="individualNpwp" name="individual_npwp" type="text" inputmode="numeric" minlength="15" maxlength="16" pattern="[0-9]{15,16}" required placeholder="15 / 16 digits" data-ocr-field="npwp">
                            </div>

                            <div class="borrower-field borrower-field--span-2">
                                <label for="individualKtpAddress">11. Address as per ID Card <span>*</span></label>
                                <textarea id="individualKtpAddress" name="individual_ktp_address" rows="3" required placeholder="Address, RT/RW, Province, City/Regency, District, Subdistrict, Postal Code" data-ocr-field="ktp_address"></textarea>
                                <small>Region fields should use hierarchical dropdowns in backend/master data.</small>
                            </div>

                            <div class="borrower-field borrower-field--span-2">
                                <div class="borrower-field__label-row">
                                    <label for="individualDomicileAddress">12. Domicile Address <span>*</span></label>
                                    <label class="borrower-inline-check">
                                        <input type="checkbox" id="individualSameAsKtp" name="individual_same_as_ktp">
                                        <span>Same as ID Card address</span>
                                    </label>
                                </div>
                                <textarea id="individualDomicileAddress" name="individual_domicile_address" rows="3" required placeholder="Domicile address"></textarea>
                            </div>

                            <div class="borrower-field">
                                <label for="individualResidenceOwnership">13. Domicile Ownership Status <span>*</span></label>
                                <select id="individualResidenceOwnership" name="individual_residence_ownership" required>
                                    <option value="">Select ownership...</option>
                                    <option>Self-owned</option>
                                    <option>Spouse-owned</option>
                                    <option>Parents-owned</option>
                                    <option>Children-owned</option>
                                    <option>Rent / Lease</option>
                                    <option>Official Residence</option>
                                    <option>Other</option>
                                </select>
                            </div>

                            <div class="borrower-field">
                                <label for="individualResidenceYears">14. Length of Stay (Years) <span>*</span></label>
                                <input id="individualResidenceYears" name="individual_residence_years" type="number" min="0" step="1" required placeholder="Years">
                            </div>

                            <div class="borrower-field">
                                <label for="individualPhone">15. Borrower Mobile Number <span>*</span></label>
                                <input id="individualPhone" name="individual_phone" type="tel" inputmode="numeric" minlength="10" maxlength="13" pattern="[0-9]{10,13}" required placeholder="08xx / 628xx" data-ocr-field="phone">
                                <small>10-13 digits; used for installment reminders.</small>
                            </div>

                            <div class="borrower-field">
                                <label for="individualEmail">16. Borrower Email <span>*</span></label>
                                <input id="individualEmail" name="individual_email" type="email" required placeholder="name@example.com" data-ocr-field="email">
                                <small>Used for e-sign and notifications.</small>
                            </div>

                            <div class="borrower-field">
                                <label for="individualEmergencyName">17. Emergency Contact Name <span>*</span></label>
                                <input id="individualEmergencyName" name="individual_emergency_name" type="text" required placeholder="Emergency contact name">
                                <small>Emergency contact must not live in the same household.</small>
                            </div>

                            <div class="borrower-field">
                                <label for="individualEmergencyRelation">18. Emergency Contact Relationship <span>*</span></label>
                                <select id="individualEmergencyRelation" name="individual_emergency_relation" required>
                                    <option value="">Select relationship...</option>
                                    <option>Parent</option>
                                    <option>Sibling</option>
                                    <option>Child</option>
                                    <option>Relative</option>
                                    <option>Friend</option>
                                    <option>Other</option>
                                </select>
                            </div>

                            <div class="borrower-field">
                                <label for="individualEmergencyPhone">19. Emergency Contact Mobile Number <span>*</span></label>
                                <input id="individualEmergencyPhone" name="individual_emergency_phone" type="tel" inputmode="numeric" minlength="10" maxlength="13" pattern="[0-9]{10,13}" required placeholder="10 - 13 digits">
                                <small>Must not be the same as the borrower's mobile number.</small>
                            </div>
                        </div>
                    </section>

                    <!-- =====================================================
                         B. BUSINESS ENTITY BORROWER - 17 FIELDS
                         Visible only when borrower_type = business
                         ===================================================== -->
                    <section class="borrower-template" id="borrowerBusinessForm" data-borrower-template="business">
                        <div class="borrower-template__header">
                            <div>
                                <span class="borrower-template__eyebrow">B. Business Entity Borrower</span>
                                <h2>Business Entity Information</h2>
                                <p>17 fields based on the Business Entity Borrower data specification.</p>
                            </div>
                            <span class="borrower-template__count">17 Fields</span>
                        </div>

                        <div class="borrower-form-grid">
                            <div class="borrower-field borrower-field--span-2">
                                <label for="businessName">1. Business Entity Name <span>*</span></label>
                                <input id="businessName" name="business_name" type="text" required placeholder="Business entity name" data-ocr-field="business_name">
                            </div>

                            <div class="borrower-field">
                                <label for="businessLegalForm">2. Legal Form <span>*</span></label>
                                <select id="businessLegalForm" name="business_legal_form" required data-ocr-field="legal_form">
                                    <option value="">Select legal form...</option>
                                    <option>PT</option><option>CV</option><option>Firma</option><option>Koperasi</option><option>Yayasan</option><option>Lainnya</option>
                                </select>
                            </div>

                            <div class="borrower-field">
                                <label for="businessNib">3. NIB <span>*</span></label>
                                <input id="businessNib" name="business_nib" type="text" inputmode="numeric" minlength="13" maxlength="13" pattern="[0-9]{13}" required placeholder="13-digit NIB" data-ocr-field="nib">
                            </div>

                            <div class="borrower-field">
                                <label for="businessNpwp">4. Business NPWP <span>*</span></label>
                                <input id="businessNpwp" name="business_npwp" type="text" inputmode="numeric" minlength="15" maxlength="16" pattern="[0-9]{15,16}" required placeholder="15 / 16 digits" data-ocr-field="business_npwp">
                            </div>

                            <div class="borrower-field">
                                <label for="businessEstablishmentDate">5. Establishment Date <span>*</span></label>
                                <input id="businessEstablishmentDate" name="business_establishment_date" type="date" required data-ocr-field="establishment_date">
                                <small>Business age is calculated automatically.</small>
                            </div>

                            <div class="borrower-field borrower-field--compound">
                                <label>6. Deed of Establishment No. &amp; Date <span>*</span></label>
                                <div class="borrower-compound-grid">
                                    <input name="business_deed_establishment_no" type="text" required placeholder="Deed number" data-ocr-field="deed_establishment_no">
                                    <input name="business_deed_establishment_date" type="date" required data-ocr-field="deed_establishment_date">
                                </div>
                            </div>

                            <div class="borrower-field">
                                <label for="businessNotaryName">7. Establishment Deed Notary Name</label>
                                <input id="businessNotaryName" name="business_notary_name" type="text" placeholder="Notary name" data-ocr-field="notary_name">
                            </div>

                            <div class="borrower-field borrower-field--compound">
                                <label>8. Latest Amendment Deed No. &amp; Date</label>
                                <div class="borrower-compound-grid">
                                    <input name="business_latest_amendment_no" type="text" placeholder="Amendment deed number" data-ocr-field="amendment_no">
                                    <input name="business_latest_amendment_date" type="date" data-ocr-field="amendment_date">
                                </div>
                            </div>

                            <div class="borrower-field">
                                <label for="businessSkEstablishment">9. Ministry of Law Establishment Decree No.</label>
                                <input id="businessSkEstablishment" name="business_sk_establishment" type="text" placeholder="SK Pendirian Kemenkumham" data-ocr-field="sk_establishment">
                                <small>Conditional: required for PT.</small>
                            </div>

                            <div class="borrower-field">
                                <label for="businessSkAmendment">10. Latest Amendment Decree No.</label>
                                <input id="businessSkAmendment" name="business_sk_amendment" type="text" placeholder="Latest amendment decree number" data-ocr-field="sk_amendment">
                            </div>

                            <div class="borrower-field borrower-field--span-2">
                                <label for="businessNibAddress">11. Address as per NIB <span>*</span></label>
                                <textarea id="businessNibAddress" name="business_nib_address" rows="3" required placeholder="Address + region" data-ocr-field="nib_address"></textarea>
                            </div>

                            <div class="borrower-field borrower-field--span-2">
                                <div class="borrower-field__label-row">
                                    <label for="businessDomicileAddress">12. Business Domicile Address <span>*</span></label>
                                    <label class="borrower-inline-check">
                                        <input type="checkbox" id="businessSameAsNib" name="business_same_as_nib">
                                        <span>Same as NIB address</span>
                                    </label>
                                </div>
                                <textarea id="businessDomicileAddress" name="business_domicile_address" rows="3" required placeholder="Business domicile address"></textarea>
                            </div>

                            <div class="borrower-field">
                                <label for="businessPremiseOwnership">13. Business Premise Ownership Status <span>*</span></label>
                                <select id="businessPremiseOwnership" name="business_premise_ownership" required>
                                    <option value="">Select ownership...</option>
                                    <option>Self-owned</option>
                                    <option>Management-owned</option>
                                    <option>Rent / Lease</option>
                                    <option>Other</option>
                                </select>
                            </div>

                            <div class="borrower-field">
                                <label for="businessOfficePhone">14. Office Phone Number <span>*</span></label>
                                <input id="businessOfficePhone" name="business_office_phone" type="tel" inputmode="numeric" required placeholder="Office phone number" data-ocr-field="office_phone">
                            </div>

                            <div class="borrower-field">
                                <label for="businessEmail">15. Business Email <span>*</span></label>
                                <input id="businessEmail" name="business_email" type="email" required placeholder="company@example.com" data-ocr-field="business_email">
                            </div>

                            <div class="borrower-field borrower-field--compound">
                                <label>16. Contact Person Name &amp; Mobile No. <span>*</span></label>
                                <div class="borrower-compound-grid">
                                    <input name="business_contact_person_name" type="text" required placeholder="Contact person name" data-ocr-field="contact_person_name">
                                    <input name="business_contact_person_phone" type="tel" inputmode="numeric" required placeholder="Mobile number" data-ocr-field="contact_person_phone">
                                </div>
                            </div>

                            <div class="borrower-field borrower-field--span-2 borrower-field--compound">
                                <label>17. Emergency Contact Name, Relationship &amp; Mobile No. <span>*</span></label>
                                <div class="borrower-compound-grid borrower-compound-grid--3">
                                    <input name="business_emergency_name" type="text" required placeholder="Emergency contact name">
                                    <select name="business_emergency_relation" required>
                                        <option value="">Select relationship...</option>
                                    </select>
                                    <input name="business_emergency_phone" type="tel" inputmode="numeric" required placeholder="Mobile number">
                                </div>
                            </div>
                        </div>
                    </section>

                    <footer class="new-app-page-actions">

                        <div class="new-app-page-actions__info">
                            Step 3 of 8 — Borrower Data
                        </div>

                        <div class="new-app-page-actions__buttons">

                            <div class="new-app-draft-control">
                                <button
                                    type="button"
                                    class="new-app-btn new-app-btn--secondary new-app-save-draft"
                                    data-save-draft="borrowerData">
                                    <i class="fa-regular fa-floppy-disk" aria-hidden="true"></i>
                                    Save as Draft
                                </button>

                                <span class="new-app-draft-time" data-draft-time="borrowerData">
                                    <i class="fa-regular fa-clock" aria-hidden="true"></i>
                                    <span>Created: — &middot; Last saved: —</span>
                                </span>
                            </div>


                            <a href="#docUpload"
                                class="new-app-btn new-app-btn--secondary">
                                <i class="fa-solid fa-arrow-left"></i>
                                Previous
                            </a>

                            <a href="#employmentBusiness"
                                class="new-app-btn new-app-btn--primary">
                                Continue
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                        </div>

                    </footer>

                </section>



                <!-- =============================================
             STEP 4 - EMPLOYMENT / BUSINESS INFORMATION
             ============================================= -->
                <section
                    class="new-app-page"
                    id="employmentBusiness"
                    data-step="4"
                    hidden>

                    <header class="new-app-page-header employment-business-header">
                        <div>
                            <h1>Employment / Business Information</h1>
                            <p>
                                Complete employment or business information used for income assessment,
                                business profiling, and credit verification.
                            </p>
                        </div>
                    </header>

                    <section class="new-app-form-card employment-business-card">
                        <div class="employment-business-card__header">
                            <div>
                                <span class="employment-business-card__eyebrow">Employment / Business Profile</span>
                                <h2>Employment &amp; Business Details</h2>
                                <p>Fields marked with * are mandatory. Conditional fields are activated automatically based on Employment Status.</p>
                            </div>
                            <span class="employment-business-card__count">14 Fields</span>
                        </div>

                        <div class="employment-business-grid">

                            <div class="employment-field">
                                <label for="employmentStatus">1. Employment Status <span>*</span></label>
                                <select id="employmentStatus" name="employment_status" required>
                                    <option value="">Select employment status...</option>
                                    <option value="permanent_employee">Permanent Employee</option>
                                    <option value="contract_employee">Contract Employee</option>
                                    <option value="business_owner">Business Owner</option>
                                    <option value="professional">Professional</option>
                                    <option value="other">Other</option>
                                </select>
                                <small>Determines the conditional fields displayed below.</small>
                            </div>

                            <div class="employment-field">
                                <label for="employmentCompanyName">2. Employer / Business Name <span>*</span></label>
                                <input id="employmentCompanyName" name="employment_company_name" type="text" maxlength="150" required placeholder="Enter employer or business name">
                            </div>

                            <div class="employment-field">
                                <label for="employmentSector">3. Business Sector <span>*</span></label>
                                <select id="employmentSector" name="employment_sector" required>
                                    <option value="">Select economic sector...</option>
                                    <option>Trading</option>
                                    <option>Construction</option>
                                    <option>Services</option>
                                    <option>Manufacturing</option>
                                    <option>Other</option>
                                </select>
                                <small>Used for portfolio reporting by economic sector.</small>
                            </div>

                            <div class="employment-field">
                                <label for="employmentType">4. Employment / Business Type <span>*</span></label>
                                <input id="employmentType" name="employment_type" type="text" maxlength="150" required placeholder="Brief description of occupation or business activity">
                            </div>

                            <div class="employment-field employment-conditional" data-employment-conditional="employee" hidden>
                                <label for="employmentPosition">5. Position / Job Title <span>*</span></label>
                                <input id="employmentPosition" name="employment_position" type="text" maxlength="100" placeholder="Enter position or job title">
                                <small>Required for Permanent Employee and Contract Employee.</small>
                            </div>

                            <div class="employment-field employment-field--compound">
                                <label>6. Length of Employment / Business <span>*</span></label>
                                <div class="employment-duration-grid">
                                    <div class="employment-input-suffix">
                                        <input id="employmentYears" name="employment_years" type="number" min="0" max="99" step="1" required placeholder="0">
                                        <span>Years</span>
                                    </div>
                                    <div class="employment-input-suffix">
                                        <input id="employmentMonths" name="employment_months" type="number" min="0" max="11" step="1" required placeholder="0">
                                        <span>Months</span>
                                    </div>
                                </div>
                            </div>

                            <div class="employment-field employment-field--span-2">
                                <label for="employmentAddress">7. Office / Business Address <span>*</span></label>
                                <textarea id="employmentAddress" name="employment_address" rows="3" required placeholder="Office / business address + region"></textarea>
                            </div>

                            <div class="employment-field">
                                <label for="employmentOfficePhone">8. Office / Business Phone Number</label>
                                <input id="employmentOfficePhone" name="employment_office_phone" type="tel" inputmode="numeric" maxlength="20" placeholder="Office / business phone number">
                                <small>Optional.</small>
                            </div>

                            <div class="employment-field employment-conditional" data-employment-conditional="business-owner" hidden>
                                <label for="employmentBusinessNpwp">9. Business NPWP</label>
                                <input id="employmentBusinessNpwp" name="employment_business_npwp" type="text" inputmode="numeric" minlength="15" maxlength="16" pattern="[0-9]{15,16}" placeholder="15 or 16 digits">
                                <small>Conditional for Business Owner when a business NPWP is available.</small>
                            </div>

                            <div class="employment-field employment-conditional" data-employment-conditional="business-owner" hidden>
                                <label for="employmentNib">10. NIB <span>*</span></label>
                                <input id="employmentNib" name="employment_nib" type="text" inputmode="numeric" minlength="13" maxlength="13" pattern="[0-9]{13}" placeholder="13 digits">
                                <small>Required for Business Owner.</small>
                            </div>

                            <div class="employment-field employment-conditional" data-employment-conditional="business-owner" hidden>
                                <label for="employmentEmployeeCount">11. Number of Employees <span>*</span></label>
                                <input id="employmentEmployeeCount" name="employment_employee_count" type="number" min="0" step="1" placeholder="0">
                                <small>Required for Business Owner.</small>
                            </div>

                            <div class="employment-field">
                                <label for="employmentMonthlyIncome">12. Monthly Income / Revenue (Rp) <span>*</span></label>
                                <div class="employment-money-input">
                                    <span>Rp</span>
                                    <input id="employmentMonthlyIncome" name="employment_monthly_income" type="text" inputmode="numeric" required placeholder="0" data-rupiah-input>
                                </div>
                                <small>Borrower declaration; subject to Credit Analyst verification.</small>
                            </div>

                            <div class="employment-field">
                                <label for="employmentOtherIncome">13. Other Monthly Income (Rp)</label>
                                <div class="employment-money-input">
                                    <span>Rp</span>
                                    <input id="employmentOtherIncome" name="employment_other_income" type="text" inputmode="numeric" placeholder="0" data-rupiah-input>
                                </div>
                                <small>Optional.</small>
                            </div>

                            <div class="employment-field">
                                <label for="employmentOtherInstallments">14. Other Monthly Installment Obligations (Rp) <span>*</span></label>
                                <div class="employment-money-input">
                                    <span>Rp</span>
                                    <input id="employmentOtherInstallments" name="employment_other_installments" type="text" inputmode="numeric" required placeholder="0" data-rupiah-input>
                                </div>
                                <small>Borrower declaration; will be matched against SLIK.</small>
                            </div>

                        </div>
                    </section>

                    <footer class="new-app-page-actions">

                        <div class="new-app-page-actions__info">
                            Step 4 of 8 — Employment / Business Information
                        </div>

                        <div class="new-app-page-actions__buttons">

                            <div class="new-app-draft-control">
                                <button
                                    type="button"
                                    class="new-app-btn new-app-btn--secondary new-app-save-draft"
                                    data-save-draft="employmentBusiness">
                                    <i class="fa-regular fa-floppy-disk" aria-hidden="true"></i>
                                    Save as Draft
                                </button>

                                <span class="new-app-draft-time" data-draft-time="employmentBusiness">
                                    <i class="fa-regular fa-clock" aria-hidden="true"></i>
                                    <span>Created: — &middot; Last saved: —</span>
                                </span>
                            </div>


                            <a href="#borrowerData"
                                class="new-app-btn new-app-btn--secondary">
                                <i class="fa-solid fa-arrow-left"></i>
                                Previous
                            </a>

                            <a href="#spouseManagement"
                                class="new-app-btn new-app-btn--primary">
                                Continue
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                        </div>

                    </footer>

                </section>

                <!-- =============================================
             STEP 5 - SPOUSE / MANAGEMENT & SHAREHOLDER
             M02.4
             ============================================= -->
                <section
                    class="new-app-page"
                    id="spouseManagement"
                    data-step="5"
                    hidden>

                    <header class="new-app-page-header related-parties-header">
                        <div>
                            <h1>Spouse / Management &amp; Shareholder</h1>
                            <p>
                                Complete spouse information for married individual borrowers, or management
                                and shareholder information for business entity borrowers.
                            </p>
                        </div>

                    </header>

                    <div class="related-parties-context" id="relatedPartiesContext">
                        <div class="related-parties-context__icon" aria-hidden="true">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div>
                            <strong id="relatedPartiesContextTitle">Business Entity</strong>
                            <span id="relatedPartiesContextText">Complete management and shareholder information below.</span>
                        </div>
                    </div>

                    <!-- A. SPOUSE DATA - INDIVIDUAL + MARRIED ONLY -->
                    <section class="new-app-form-card related-party-card" id="spouseBorrowerPanel" hidden>
                        <div class="related-party-card__header">
                            <div>
                                <span class="related-party-card__eyebrow">A. Individual Borrower</span>
                                <h2>Spouse Data</h2>
                                <p>This section is required only when Marital Status is Married.</p>
                            </div>
                            <span class="related-party-card__count">7 Fields</span>
                        </div>

                        <div class="related-party-grid">
                            <div class="related-party-field">
                                <label for="spouseFullName">1. Spouse Full Name (as per ID Card) <span>*</span></label>
                                <input id="spouseFullName" name="spouse_full_name" type="text" maxlength="100" required placeholder="Enter spouse full name">
                            </div>

                            <div class="related-party-field">
                                <label for="spouseNik">2. Spouse NIK <span>*</span></label>
                                <input id="spouseNik" name="spouse_nik" type="text" inputmode="numeric" minlength="16" maxlength="16" pattern="[0-9]{16}" required placeholder="16-digit NIK">
                                <small>Must be different from the borrower's NIK.</small>
                            </div>

                            <div class="related-party-field related-party-field--span-2 related-party-field--compound">
                                <label>3. Place &amp; Date of Birth <span>*</span></label>
                                <div class="related-party-compound-grid">
                                    <input id="spouseBirthPlace" name="spouse_birth_place" type="text" maxlength="100" required placeholder="Place of birth">
                                    <input id="spouseBirthDate" name="spouse_birth_date" type="date" required aria-label="Spouse date of birth">
                                </div>
                            </div>

                            <div class="related-party-field">
                                <label for="spousePhone">4. Spouse Mobile Number <span>*</span></label>
                                <input id="spousePhone" name="spouse_phone" type="tel" inputmode="numeric" minlength="10" maxlength="13" pattern="[0-9]{10,13}" required placeholder="10-13 digits">
                            </div>

                            <div class="related-party-field">
                                <label for="spouseOccupation">5. Spouse Occupation <span>*</span></label>
                                <select id="spouseOccupation" name="spouse_occupation" required>
                                    <option value="">Select occupation...</option>
                                    <option value="employee">Employee</option>
                                    <option value="entrepreneur">Entrepreneur</option>
                                    <option value="professional">Professional</option>
                                    <option value="homemaker">Homemaker</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="related-party-field">
                                <label for="spouseMonthlyIncome">6. Spouse Monthly Income (Rp)</label>
                                <div class="related-party-money-input">
                                    <span>Rp</span>
                                    <input id="spouseMonthlyIncome" name="spouse_monthly_income" type="text" inputmode="numeric" placeholder="0" data-related-rupiah>
                                </div>
                                <small>Optional.</small>
                            </div>

                            <div class="related-party-field">
                                <label for="spouseSignsAgreement">7. Spouse Signs Credit Agreement <span>*</span></label>
                                <select id="spouseSignsAgreement" name="spouse_signs_agreement" required>
                                    <option value="yes" selected>Yes</option>
                                    <option value="no">No</option>
                                </select>
                                <small>Default: Yes (spouse consent).</small>
                            </div>
                        </div>
                    </section>

                    <!-- INDIVIDUAL BUT NOT MARRIED -->
                    <section class="related-party-empty" id="spouseNotRequiredPanel" hidden>
                        <div class="related-party-empty__icon">
                            <i class="fa-regular fa-circle-check" aria-hidden="true"></i>
                        </div>
                        <div>
                            <strong>Spouse data is not required</strong>
                            <p>This borrower is not marked as Married in Borrower Data. Change Marital Status to Married if spouse information is required.</p>
                        </div>
                    </section>

                    <!-- B. MANAGEMENT & SHAREHOLDERS - BUSINESS ENTITY ONLY -->
                    <section class="new-app-form-card related-party-card management-card" id="managementShareholderPanel">
                        <div class="related-party-card__header management-card__header">
                            <div>
                                <span class="related-party-card__eyebrow">B. Business Entity</span>
                                <h2>Management &amp; Shareholders</h2>
                                <p>Add management, directors, commissioners, partners, and shareholders as separate rows.</p>
                            </div>

                            <button class="management-add-button" id="addManagementPerson" type="button">
                                <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                Add Person
                            </button>
                        </div>

                        <div class="management-ownership-summary" id="managementOwnershipSummary">
                            <div>
                                <span>Shareholder Ownership Total</span>
                                <strong id="managementOwnershipTotal">0%</strong>
                            </div>
                            <div class="management-ownership-track" aria-hidden="true">
                                <span id="managementOwnershipFill"></span>
                            </div>
                            <small id="managementOwnershipMessage">If shareholder rows are added, total ownership must equal 100%.</small>
                        </div>

                        <div class="management-rows" id="managementRows">

                            <!-- First management/shareholder row is rendered in PHP for backend clarity. -->
                            <article class="management-person-card" data-management-row data-management-index="0">
                                <div class="management-person-card__header">
                                    <div class="management-person-card__title">
                                        <span class="management-person-card__number">1</span>
                                        <span>Management / Shareholder Person 1</span>
                                    </div>

                                    <button class="management-remove-button" type="button" data-management-remove disabled>
                                        <i class="fa-regular fa-trash-can" aria-hidden="true"></i>
                                        Remove
                                    </button>
                                </div>

                                <div class="related-party-grid management-person-grid">
                                    <div class="related-party-field">
                                        <label>1. Full Name (as per ID Card) <span>*</span></label>
                                        <input data-management-field="name" name="management[0][name]" type="text" maxlength="100" required placeholder="Enter full name">
                                    </div>

                                    <div class="related-party-field">
                                        <label>2. NIK <span>*</span></label>
                                        <input data-management-field="nik" name="management[0][nik]" type="text" inputmode="numeric" minlength="16" maxlength="16" pattern="[0-9]{16}" required placeholder="16-digit NIK">
                                    </div>

                                    <div class="related-party-field">
                                        <label>3. Position / Role <span>*</span></label>
                                        <select data-management-field="role" name="management[0][role]" required>
                                            <option value="">Select position...</option>
                                            <option value="president_director">President Director</option>
                                            <option value="director">Director</option>
                                            <option value="president_commissioner">President Commissioner</option>
                                            <option value="commissioner">Commissioner</option>
                                            <option value="shareholder">Shareholder</option>
                                            <option value="active_partner">Active Partner</option>
                                            <option value="passive_partner">Passive Partner</option>
                                        </select>
                                    </div>

                                    <div class="related-party-field management-share-field is-disabled" data-management-share-field>
                                        <label>4. Share Ownership (%) <span data-management-ownership-required hidden>*</span></label>
                                        <div class="related-party-money-input">
                                            <input data-management-field="ownership" name="management[0][ownership]" type="number" min="0" max="100" step="0.01" placeholder="0" disabled>
                                            <span>%</span>
                                        </div>
                                        <small data-management-share-note>Only required when Position / Role is Shareholder.</small>
                                    </div>

                                    <div class="related-party-field">
                                        <label>5. Mobile Number <span>*</span></label>
                                        <input data-management-field="phone" name="management[0][phone]" type="tel" inputmode="numeric" required placeholder="Mobile number">
                                    </div>

                                    <div class="related-party-field related-party-field--span-2 management-address-field">
                                        <label>6. Address <span>*</span></label>
                                        <textarea data-management-field="address" name="management[0][address]" rows="3" required placeholder="Enter residential address"></textarea>
                                    </div>

                                    <div class="related-party-field related-party-field--span-2 management-guarantee-field">
                                        <label>7. Personal Guarantee <span>*</span></label>
                                        <select data-management-field="guarantee" name="management[0][guarantee]" required>
                                            <option value="">Select personal guarantee...</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        <small>Yes = automatically included in identity &amp; background checking.</small>
                                    </div>
                                </div>
                            </article>

                        </div>

                        <!--
                            PHP-owned markup source for additional management/shareholder rows.
                            JavaScript only clones, binds behavior, and reindexes backend field names.
                        -->
                        <template id="managementRowTemplate">
                            <article class="management-person-card" data-management-row data-management-index="0">
                                <div class="management-person-card__header">
                                    <div class="management-person-card__title">
                                        <span class="management-person-card__number">1</span>
                                        <span>Management / Shareholder Person 1</span>
                                    </div>

                                    <button class="management-remove-button" type="button" data-management-remove>
                                        <i class="fa-regular fa-trash-can" aria-hidden="true"></i>
                                        Remove
                                    </button>
                                </div>

                                <div class="related-party-grid management-person-grid">
                                    <div class="related-party-field">
                                        <label>1. Full Name (as per ID Card) <span>*</span></label>
                                        <input data-management-field="name" name="management[0][name]" type="text" maxlength="100" required placeholder="Enter full name">
                                    </div>

                                    <div class="related-party-field">
                                        <label>2. NIK <span>*</span></label>
                                        <input data-management-field="nik" name="management[0][nik]" type="text" inputmode="numeric" minlength="16" maxlength="16" pattern="[0-9]{16}" required placeholder="16-digit NIK">
                                    </div>

                                    <div class="related-party-field">
                                        <label>3. Position / Role <span>*</span></label>
                                        <select data-management-field="role" name="management[0][role]" required>
                                            <option value="">Select position...</option>
                                            <option value="president_director">President Director</option>
                                            <option value="director">Director</option>
                                            <option value="president_commissioner">President Commissioner</option>
                                            <option value="commissioner">Commissioner</option>
                                            <option value="shareholder">Shareholder</option>
                                            <option value="active_partner">Active Partner</option>
                                            <option value="passive_partner">Passive Partner</option>
                                        </select>
                                    </div>

                                    <div class="related-party-field management-share-field is-disabled" data-management-share-field>
                                        <label>4. Share Ownership (%) <span data-management-ownership-required hidden>*</span></label>
                                        <div class="related-party-money-input">
                                            <input data-management-field="ownership" name="management[0][ownership]" type="number" min="0" max="100" step="0.01" placeholder="0" disabled>
                                            <span>%</span>
                                        </div>
                                        <small data-management-share-note>Only required when Position / Role is Shareholder.</small>
                                    </div>

                                    <div class="related-party-field">
                                        <label>5. Mobile Number <span>*</span></label>
                                        <input data-management-field="phone" name="management[0][phone]" type="tel" inputmode="numeric" required placeholder="Mobile number">
                                    </div>

                                    <div class="related-party-field related-party-field--span-2 management-address-field">
                                        <label>6. Address <span>*</span></label>
                                        <textarea data-management-field="address" name="management[0][address]" rows="3" required placeholder="Enter residential address"></textarea>
                                    </div>

                                    <div class="related-party-field related-party-field--span-2 management-guarantee-field">
                                        <label>7. Personal Guarantee <span>*</span></label>
                                        <select data-management-field="guarantee" name="management[0][guarantee]" required>
                                            <option value="">Select personal guarantee...</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        <small>Yes = automatically included in identity &amp; background checking.</small>
                                    </div>
                                </div>
                            </article>
                        </template>
                    </section>

                    <footer class="new-app-page-actions">

                        <div class="new-app-page-actions__info">
                            Step 5 of 8 — Spouse / Management &amp; Shareholder
                        </div>

                        <div class="new-app-page-actions__buttons">

                            <div class="new-app-draft-control">
                                <button
                                    type="button"
                                    class="new-app-btn new-app-btn--secondary new-app-save-draft"
                                    data-save-draft="spouseManagement">
                                    <i class="fa-regular fa-floppy-disk" aria-hidden="true"></i>
                                    Save as Draft
                                </button>

                                <span class="new-app-draft-time" data-draft-time="spouseManagement">
                                    <i class="fa-regular fa-clock" aria-hidden="true"></i>
                                    <span>Created: — &middot; Last saved: —</span>
                                </span>
                            </div>

                            <a href="#employmentBusiness"
                                class="new-app-btn new-app-btn--secondary">
                                <i class="fa-solid fa-arrow-left"></i>
                                Previous
                            </a>

                            <a href="#collateral"
                                class="new-app-btn new-app-btn--primary">
                                Continue
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                        </div>

                    </footer>

                </section>


<!-- =============================================
             STEP 6 - COLLATERAL & COLLATERAL OWNER
             ============================================= -->
                <section
                    class="new-app-page"
                    id="collateral"
                    data-step="6"
                    hidden>

                    <header class="new-app-page-header collateral-page-header">
                        <div>
                            <h1>Collateral &amp; Collateral Owner</h1>
                            <p>
                                Register one or more collateral assets, ownership information,
                                certificate details, and appraisal-linked values.
                            </p>
                        </div>
                    </header>

                    <div class="collateral-step-stack" id="collateralStepRoot">

                        <div class="collateral-info-banner">
                            <i class="fa-regular fa-lightbulb" aria-hidden="true"></i>
                            <div>
                                <strong>Multiple collateral assets are supported</strong>
                                <p>
                                    Add each collateral separately. Market Value and Liquidation Value remain read-only
                                    until appraisal data is returned.
                                </p>
                            </div>
                        </div>

                        <!-- A. COLLATERAL DETAILS -->
                        <section class="new-app-form-card collateral-list-card">
                            <div class="collateral-section-header">
                                <div>
                                    <span class="collateral-section-eyebrow">Collateral Details</span>
                                    <h2>Collateral Information</h2>
                                    <p>Fields 1–23. Add a separate card for every collateral asset.</p>
                                </div>

                                <button class="collateral-add-button" id="addCollateralButton" type="button">
                                    <i class="fa-solid fa-plus" aria-hidden="true"></i>
                                    Add Collateral
                                </button>
                            </div>

                            <div class="collateral-rows" id="collateralRows">

                                <article class="collateral-card" data-collateral-row data-collateral-index="0">
                                    <div class="collateral-card__header">
                                        <div class="collateral-card__title">
                                            <span class="collateral-card__number">1</span>
                                            <div>
                                                <strong>Collateral 1</strong>
                                                <small>Collateral sequence number is generated automatically</small>
                                            </div>
                                        </div>

                                        <button class="collateral-remove-button" type="button" data-collateral-remove>
                                            <i class="fa-regular fa-trash-can" aria-hidden="true"></i>
                                            Remove
                                        </button>
                                    </div>

                                    <div class="collateral-card__body">
                                        <div class="collateral-form-grid">
                                            <div class="collateral-field">
                                                <label>1. Collateral No.</label>
                                                <input data-collateral-field="number" name="collateral[0][number]" type="text" value="1" readonly>
                                                <small>Automatic: 1, 2, 3...</small>
                                            </div>

                                            <div class="collateral-field">
                                                <label>2. Collateral Type <span>*</span></label>
                                                <select data-collateral-field="type" name="collateral[0][type]" required>
                                                    <option value="">Select collateral type...</option>
                                                    <option value="house">House</option>
                                                    <option value="shop_house">Shop House / Rukan</option>
                                                    <option value="office">Office</option>
                                                    <option value="warehouse">Warehouse</option>
                                                    <option value="apartment">Apartment</option>
                                                    <option value="vacant_land">Vacant Land</option>
                                                </select>
                                            </div>

                                            <div class="collateral-field collateral-field--span-2">
                                                <label>3. Collateral Address <span>*</span></label>
                                                <textarea data-collateral-field="address" name="collateral[0][address]" required placeholder="Full address, province, city/regency, district, subdistrict, postal code"></textarea>
                                            </div>

                                            <div class="collateral-field collateral-field--span-2">
                                                <label>4. Coordinates</label>
                                                <div class="collateral-coordinate-grid">
                                                    <input data-collateral-field="latitude" name="collateral[0][latitude]" type="number" step="any" placeholder="Latitude">
                                                    <input data-collateral-field="longitude" name="collateral[0][longitude]" type="number" step="any" placeholder="Longitude">
                                                </div>
                                                <div class="collateral-map-actions">
                                                    <button class="collateral-mini-button" type="button" data-use-location>
                                                        <i class="fa-solid fa-location-crosshairs" aria-hidden="true"></i>
                                                        Use Current Location
                                                    </button>
                                                    <button class="collateral-mini-button" type="button" data-open-map>
                                                        <i class="fa-solid fa-map-location-dot" aria-hidden="true"></i>
                                                        Open Map
                                                    </button>
                                                </div>
                                                <small>Optional. Latitude / Longitude helps appraisal survey planning.</small>
                                            </div>

                                            <div class="collateral-field">
                                                <label>5. Certificate Type <span>*</span></label>
                                                <select data-collateral-field="certificate_type" name="collateral[0][certificate_type]" required>
                                                    <option value="">Select certificate...</option>
                                                    <option value="SHM">SHM</option>
                                                    <option value="SHGB">SHGB</option>
                                                    <option value="SHMSRS">SHMSRS</option>
                                                </select>
                                            </div>

                                            <div class="collateral-field">
                                                <label>6. Certificate No. <span>*</span></label>
                                                <input data-collateral-field="certificate_no" name="collateral[0][certificate_no]" type="text" required placeholder="Enter certificate number">
                                                <small data-certificate-note>Duplicate check applies across current application rows.</small>
                                            </div>

                                            <div class="collateral-field">
                                                <label>7. Certificate Issue Date <span>*</span></label>
                                                <input data-collateral-field="certificate_issue_date" name="collateral[0][certificate_issue_date]" type="date" required>
                                            </div>

                                            <div class="collateral-field" data-certificate-expiry-field>
                                                <label>8. Right Expiry Date <span data-expiry-required>*</span></label>
                                                <input data-collateral-field="certificate_expiry_date" name="collateral[0][certificate_expiry_date]" type="date">
                                                <small data-expiry-note>Required for SHGB / SHMSRS.</small>
                                            </div>

                                            <div class="collateral-field">
                                                <label>9. Land Area <span>*</span></label>
                                                <div class="collateral-unit-input">
                                                    <input data-collateral-field="land_area" name="collateral[0][land_area]" type="number" min="0" step="0.01" required placeholder="0">
                                                    <span>m²</span>
                                                </div>
                                            </div>

                                            <div class="collateral-field">
                                                <label>10. Building / Unit Area <span>*</span></label>
                                                <div class="collateral-unit-input">
                                                    <input data-collateral-field="building_area" name="collateral[0][building_area]" type="number" min="0" step="0.01" required placeholder="0">
                                                    <span>m²</span>
                                                </div>
                                            </div>

                                            <div class="collateral-field">
                                                <label>11. IMB / PBG <span>*</span></label>
                                                <select data-collateral-field="imb_status" name="collateral[0][imb_status]" required>
                                                    <option value="">Select status...</option>
                                                    <option value="available">Available</option>
                                                    <option value="none">Not Available</option>
                                                </select>
                                            </div>

                                            <div class="collateral-field" data-imb-number-field hidden>
                                                <label>12. IMB / PBG No. <span>*</span></label>
                                                <input data-collateral-field="imb_number" name="collateral[0][imb_number]" type="text" placeholder="Enter IMB / PBG number">
                                                <small>Required when IMB / PBG is Available.</small>
                                            </div>

                                            <div class="collateral-field">
                                                <label>13. Owner Name as per Certificate <span>*</span></label>
                                                <input data-collateral-field="owner_name" name="collateral[0][owner_name]" type="text" maxlength="100" required placeholder="Owner name on certificate">
                                            </div>

                                            <div class="collateral-field">
                                                <label>14. Owner Relationship to Borrower <span>*</span></label>
                                                <select data-collateral-field="owner_relationship" name="collateral[0][owner_relationship]" required>
                                                    <option value="">Select relationship...</option>
                                                    <option value="borrower">Borrower</option>
                                                    <option value="spouse">Borrower's Spouse</option>
                                                    <option value="parent">Parent</option>
                                                    <option value="child">Child</option>
                                                    <option value="sibling">Sibling</option>
                                                    <option value="borrower_company">Borrower Business Entity</option>
                                                    <option value="management">Management</option>
                                                    <option value="third_party">Third Party</option>
                                                </select>
                                            </div>

                                            <div class="collateral-field" data-owner-reference-field hidden>
                                                <label>15. Collateral Owner No. <span>*</span></label>
                                                <select data-collateral-field="owner_reference" name="collateral[0][owner_reference]">
                                                    <option value="">Select collateral owner...</option>
                                                </select>
                                                <small>Links this collateral to the owner record below.</small>
                                            </div>

                                            <div class="collateral-field">
                                                <label>16. Ownership Duration <span>*</span></label>
                                                <div class="collateral-unit-input">
                                                    <input data-collateral-field="ownership_years" name="collateral[0][ownership_years]" type="number" min="0" step="0.1" required placeholder="0">
                                                    <span>Year</span>
                                                </div>
                                                <small data-ownership-warning>Warning will appear when ownership is less than 1 year.</small>
                                            </div>

                                            <div class="collateral-field">
                                                <label>17. Collateral Occupancy Status <span>*</span></label>
                                                <select data-collateral-field="occupancy_status" name="collateral[0][occupancy_status]" required>
                                                    <option value="">Select status...</option>
                                                    <option value="self_occupied">Owner Occupied</option>
                                                    <option value="rented">Rented</option>
                                                    <option value="vacant">Vacant</option>
                                                    <option value="occupied_by_other">Occupied by Other Party</option>
                                                </select>
                                            </div>

                                            <div class="collateral-field">
                                                <label>18. Marketing Estimated Market Value</label>
                                                <div class="collateral-money-input">
                                                    <span>Rp</span>
                                                    <input data-collateral-field="marketing_market_value" name="collateral[0][marketing_market_value]" data-collateral-rupiah type="text" inputmode="numeric" placeholder="0">
                                                </div>
                                                <small>Optional initial estimate before appraisal.</small>
                                            </div>

                                            <div class="collateral-field">
                                                <label>19. NJOP Value <span>*</span></label>
                                                <div class="collateral-money-input">
                                                    <span>Rp</span>
                                                    <input data-collateral-field="njop_value" name="collateral[0][njop_value]" data-collateral-rupiah type="text" inputmode="numeric" required placeholder="0">
                                                </div>
                                                <small>Use current-year SPPT PBB value.</small>
                                            </div>

                                            <div class="collateral-field collateral-auto-value">
                                                <label>20. Appraisal Market Value</label>
                                                <div class="collateral-money-input">
                                                    <span>Rp</span>
                                                    <input data-collateral-field="appraisal_market_value" name="collateral[0][appraisal_market_value]" type="text" value="" placeholder="Pending appraisal" readonly>
                                                </div>
                                                <small>Read-only</small>
                                            </div>

                                            <div class="collateral-field collateral-auto-value">
                                                <label>21. Liquidation Value</label>
                                                <div class="collateral-money-input">
                                                    <span>Rp</span>
                                                    <input data-collateral-field="liquidation_value" name="collateral[0][liquidation_value]" type="text" value="" placeholder="Pending appraisal" readonly>
                                                </div>
                                                <small>Read-only · linked from M03.3.</small>
                                            </div>

                                            <div class="collateral-field collateral-auto-value">
                                                <label>22. Collateral Cover (MV) — Application</label>
                                                <input data-collateral-field="cover_mv" name="collateral[0][cover_mv]" type="text" value="—" readonly>
                                                <small>Market Value ÷ Requested Plafond × 100%.</small>
                                            </div>

                                            <div class="collateral-field collateral-auto-value">
                                                <label>23. Collateral Cover (LV) — Application</label>
                                                <input data-collateral-field="cover_lv" name="collateral[0][cover_lv]" type="text" value="—" readonly>
                                                <small>Liquidation Value ÷ Requested Plafond × 100%.</small>
                                            </div>
                                        </div>
                                    </div>
                                </article>

                            </div>

                            <!--
                                Markup source for additional collateral rows.
                                The full form lives in PHP; JavaScript only clones this template,
                                binds behavior, and reindexes field names for backend submission.
                            -->
                            <template id="collateralRowTemplate">
                                <article class="collateral-card" data-collateral-row data-collateral-index="0">
                                    <div class="collateral-card__header">
                                        <div class="collateral-card__title">
                                            <span class="collateral-card__number">1</span>
                                            <div>
                                                <strong>Collateral 1</strong>
                                                <small>Collateral sequence number is generated automatically</small>
                                            </div>
                                        </div>

                                        <button class="collateral-remove-button" type="button" data-collateral-remove>
                                            <i class="fa-regular fa-trash-can" aria-hidden="true"></i>
                                            Remove
                                        </button>
                                    </div>

                                    <div class="collateral-card__body">
                                        <div class="collateral-form-grid">
                                            <div class="collateral-field">
                                                <label>1. Collateral No.</label>
                                                <input data-collateral-field="number" name="collateral[0][number]" type="text" value="1" readonly>
                                                <small>Automatic: 1, 2, 3...</small>
                                            </div>

                                            <div class="collateral-field">
                                                <label>2. Collateral Type <span>*</span></label>
                                                <select data-collateral-field="type" name="collateral[0][type]" required>
                                                    <option value="">Select collateral type...</option>
                                                    <option value="house">House</option>
                                                    <option value="shop_house">Shop House / Rukan</option>
                                                    <option value="office">Office</option>
                                                    <option value="warehouse">Warehouse</option>
                                                    <option value="apartment">Apartment</option>
                                                    <option value="vacant_land">Vacant Land</option>
                                                </select>
                                            </div>

                                            <div class="collateral-field collateral-field--span-2">
                                                <label>3. Collateral Address <span>*</span></label>
                                                <textarea data-collateral-field="address" name="collateral[0][address]" required placeholder="Full address, province, city/regency, district, subdistrict, postal code"></textarea>
                                            </div>

                                            <div class="collateral-field collateral-field--span-2">
                                                <label>4. Coordinates</label>
                                                <div class="collateral-coordinate-grid">
                                                    <input data-collateral-field="latitude" name="collateral[0][latitude]" type="number" step="any" placeholder="Latitude">
                                                    <input data-collateral-field="longitude" name="collateral[0][longitude]" type="number" step="any" placeholder="Longitude">
                                                </div>
                                                <div class="collateral-map-actions">
                                                    <button class="collateral-mini-button" type="button" data-use-location>
                                                        <i class="fa-solid fa-location-crosshairs" aria-hidden="true"></i>
                                                        Use Current Location
                                                    </button>
                                                    <button class="collateral-mini-button" type="button" data-open-map>
                                                        <i class="fa-solid fa-map-location-dot" aria-hidden="true"></i>
                                                        Open Map
                                                    </button>
                                                </div>
                                                <small>Optional. Latitude / Longitude helps appraisal survey planning.</small>
                                            </div>

                                            <div class="collateral-field">
                                                <label>5. Certificate Type <span>*</span></label>
                                                <select data-collateral-field="certificate_type" name="collateral[0][certificate_type]" required>
                                                    <option value="">Select certificate...</option>
                                                    <option value="SHM">SHM</option>
                                                    <option value="SHGB">SHGB</option>
                                                    <option value="SHMSRS">SHMSRS</option>
                                                </select>
                                            </div>

                                            <div class="collateral-field">
                                                <label>6. Certificate No. <span>*</span></label>
                                                <input data-collateral-field="certificate_no" name="collateral[0][certificate_no]" type="text" required placeholder="Enter certificate number">
                                                <small data-certificate-note>Duplicate check applies across current application rows.</small>
                                            </div>

                                            <div class="collateral-field">
                                                <label>7. Certificate Issue Date <span>*</span></label>
                                                <input data-collateral-field="certificate_issue_date" name="collateral[0][certificate_issue_date]" type="date" required>
                                            </div>

                                            <div class="collateral-field" data-certificate-expiry-field>
                                                <label>8. Right Expiry Date <span data-expiry-required>*</span></label>
                                                <input data-collateral-field="certificate_expiry_date" name="collateral[0][certificate_expiry_date]" type="date">
                                                <small data-expiry-note>Required for SHGB / SHMSRS.</small>
                                            </div>

                                            <div class="collateral-field">
                                                <label>9. Land Area <span>*</span></label>
                                                <div class="collateral-unit-input">
                                                    <input data-collateral-field="land_area" name="collateral[0][land_area]" type="number" min="0" step="0.01" required placeholder="0">
                                                    <span>m²</span>
                                                </div>
                                            </div>

                                            <div class="collateral-field">
                                                <label>10. Building / Unit Area <span>*</span></label>
                                                <div class="collateral-unit-input">
                                                    <input data-collateral-field="building_area" name="collateral[0][building_area]" type="number" min="0" step="0.01" required placeholder="0">
                                                    <span>m²</span>
                                                </div>
                                            </div>

                                            <div class="collateral-field">
                                                <label>11. IMB / PBG <span>*</span></label>
                                                <select data-collateral-field="imb_status" name="collateral[0][imb_status]" required>
                                                    <option value="">Select status...</option>
                                                    <option value="available">Available</option>
                                                    <option value="none">Not Available</option>
                                                </select>
                                            </div>

                                            <div class="collateral-field" data-imb-number-field hidden>
                                                <label>12. IMB / PBG No. <span>*</span></label>
                                                <input data-collateral-field="imb_number" name="collateral[0][imb_number]" type="text" placeholder="Enter IMB / PBG number">
                                                <small>Required when IMB / PBG is Available.</small>
                                            </div>

                                            <div class="collateral-field">
                                                <label>13. Owner Name as per Certificate <span>*</span></label>
                                                <input data-collateral-field="owner_name" name="collateral[0][owner_name]" type="text" maxlength="100" required placeholder="Owner name on certificate">
                                            </div>

                                            <div class="collateral-field">
                                                <label>14. Owner Relationship to Borrower <span>*</span></label>
                                                <select data-collateral-field="owner_relationship" name="collateral[0][owner_relationship]" required>
                                                    <option value="">Select relationship...</option>
                                                    <option value="borrower">Borrower</option>
                                                    <option value="spouse">Borrower's Spouse</option>
                                                    <option value="parent">Parent</option>
                                                    <option value="child">Child</option>
                                                    <option value="sibling">Sibling</option>
                                                    <option value="borrower_company">Borrower Business Entity</option>
                                                    <option value="management">Management</option>
                                                    <option value="third_party">Third Party</option>
                                                </select>
                                            </div>

                                            <div class="collateral-field" data-owner-reference-field hidden>
                                                <label>15. Collateral Owner No. <span>*</span></label>
                                                <select data-collateral-field="owner_reference" name="collateral[0][owner_reference]">
                                                    <option value="">Select collateral owner...</option>
                                                </select>
                                                <small>Links this collateral to the owner record below.</small>
                                            </div>

                                            <div class="collateral-field">
                                                <label>16. Ownership Duration <span>*</span></label>
                                                <div class="collateral-unit-input">
                                                    <input data-collateral-field="ownership_years" name="collateral[0][ownership_years]" type="number" min="0" step="0.1" required placeholder="0">
                                                    <span>Year</span>
                                                </div>
                                                <small data-ownership-warning>Warning will appear when ownership is less than 1 year.</small>
                                            </div>

                                            <div class="collateral-field">
                                                <label>17. Collateral Occupancy Status <span>*</span></label>
                                                <select data-collateral-field="occupancy_status" name="collateral[0][occupancy_status]" required>
                                                    <option value="">Select status...</option>
                                                    <option value="self_occupied">Owner Occupied</option>
                                                    <option value="rented">Rented</option>
                                                    <option value="vacant">Vacant</option>
                                                    <option value="occupied_by_other">Occupied by Other Party</option>
                                                </select>
                                            </div>

                                            <div class="collateral-field">
                                                <label>18. Marketing Estimated Market Value</label>
                                                <div class="collateral-money-input">
                                                    <span>Rp</span>
                                                    <input data-collateral-field="marketing_market_value" name="collateral[0][marketing_market_value]" data-collateral-rupiah type="text" inputmode="numeric" placeholder="0">
                                                </div>
                                                <small>Optional initial estimate before appraisal.</small>
                                            </div>

                                            <div class="collateral-field">
                                                <label>19. NJOP Value <span>*</span></label>
                                                <div class="collateral-money-input">
                                                    <span>Rp</span>
                                                    <input data-collateral-field="njop_value" name="collateral[0][njop_value]" data-collateral-rupiah type="text" inputmode="numeric" required placeholder="0">
                                                </div>
                                                <small>Use current-year SPPT PBB value.</small>
                                            </div>

                                            <div class="collateral-field collateral-auto-value">
                                                <label>20. Appraisal Market Value</label>
                                                <div class="collateral-money-input">
                                                    <span>Rp</span>
                                                    <input data-collateral-field="appraisal_market_value" name="collateral[0][appraisal_market_value]" type="text" value="" placeholder="Pending appraisal" readonly>
                                                </div>
                                                <small>Read-only · linked from M03.3.</small>
                                            </div>

                                            <div class="collateral-field collateral-auto-value">
                                                <label>21. Liquidation Value</label>
                                                <div class="collateral-money-input">
                                                    <span>Rp</span>
                                                    <input data-collateral-field="liquidation_value" name="collateral[0][liquidation_value]" type="text" value="" placeholder="Pending appraisal" readonly>
                                                </div>
                                                <small>Read-only · linked from M03.3.</small>
                                            </div>

                                            <div class="collateral-field collateral-auto-value">
                                                <label>22. Collateral Cover (MV) — Application</label>
                                                <input data-collateral-field="cover_mv" name="collateral[0][cover_mv]" type="text" value="—" readonly>
                                                <small>Market Value ÷ Requested Plafond × 100%.</small>
                                            </div>

                                            <div class="collateral-field collateral-auto-value">
                                                <label>23. Collateral Cover (LV) — Application</label>
                                                <input data-collateral-field="cover_lv" name="collateral[0][cover_lv]" type="text" value="—" readonly>
                                                <small>Liquidation Value ÷ Requested Plafond × 100%.</small>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </template>
                        </section>

                        <!-- B. COLLATERAL OWNER -->
                        <section class="new-app-form-card collateral-owner-section" id="collateralOwnerSection" hidden>
                            <div class="collateral-section-header">
                                <div>
                                    <span class="collateral-section-eyebrow">Conditional · Maximum 3 Owners</span>
                                    <h2>Collateral Owner 1–3</h2>
                                    <p>
                                        Required when collateral ownership is not Borrower or Borrower's Spouse.
                                        Owner records can be linked from each collateral card.
                                    </p>
                                </div>

                                <button class="collateral-add-button" id="addCollateralOwnerButton" type="button">
                                    <i class="fa-solid fa-user-plus" aria-hidden="true"></i>
                                    Add Owner
                                </button>
                            </div>

                            <div class="collateral-owner-empty" id="collateralOwnerEmpty">
                                <i class="fa-regular fa-address-card" aria-hidden="true"></i>
                                <div>
                                    <strong>No additional collateral owner yet</strong>
                                    <p>Add an owner to link collateral owned by a parent, child, sibling, company, management, or third party.</p>
                                </div>
                            </div>

                            <div class="collateral-owner-rows" id="collateralOwnerRows"></div>

                            <!--
                                Markup source for Collateral Owner 1-3.
                                Kept in PHP so controller/backend field structure remains explicit.
                            -->
                            <template id="collateralOwnerRowTemplate">
                                <article class="collateral-owner-card" data-collateral-owner-row data-owner-index="0">
                                    <div class="collateral-owner-card__header">
                                        <div class="collateral-owner-card__title">
                                            <span class="collateral-owner-card__number">1</span>
                                            <div>
                                                <strong>Collateral Owner 1</strong>
                                                <small>Additional owner information</small>
                                            </div>
                                        </div>

                                        <button class="collateral-remove-button" type="button" data-owner-remove>
                                            <i class="fa-regular fa-trash-can" aria-hidden="true"></i>
                                            Remove
                                        </button>
                                    </div>

                                    <div class="collateral-owner-card__body">
                                        <div class="collateral-owner-grid">
                                            <div class="collateral-field">
                                                <label>1. Full Name (as per ID Card) <span>*</span></label>
                                                <input data-owner-field="name" name="collateral_owner[0][name]" type="text" maxlength="100" required placeholder="Enter owner full name">
                                            </div>

                                            <div class="collateral-field">
                                                <label>2. NIK <span>*</span></label>
                                                <input data-owner-field="nik" name="collateral_owner[0][nik]" type="text" inputmode="numeric" minlength="16" maxlength="16" pattern="[0-9]{16}" required placeholder="16-digit NIK">
                                            </div>

                                            <div class="collateral-field">
                                                <label>3. Place of Birth <span>*</span></label>
                                                <input data-owner-field="birth_place" name="collateral_owner[0][birth_place]" type="text" required placeholder="City / Regency">
                                            </div>

                                            <div class="collateral-field">
                                                <label>3. Date of Birth <span>*</span></label>
                                                <input data-owner-field="birth_date" name="collateral_owner[0][birth_date]" type="date" required>
                                            </div>

                                            <div class="collateral-field">
                                                <label>4. Marital Status <span>*</span></label>
                                                <select data-owner-field="marital_status" name="collateral_owner[0][marital_status]" required>
                                                    <option value="">Select status...</option>
                                                    <option value="single">Single</option>
                                                    <option value="married">Married</option>
                                                    <option value="divorced">Divorced</option>
                                                    <option value="widowed">Widowed</option>
                                                </select>
                                            </div>

                                            <div class="collateral-field collateral-field--span-2" data-owner-spouse-field hidden>
                                                <label>5. Owner Spouse Name &amp; NIK <span>*</span></label>
                                                <div class="collateral-coordinate-grid">
                                                    <input data-owner-field="spouse_name" name="collateral_owner[0][spouse_name]" type="text" placeholder="Spouse full name">
                                                    <input data-owner-field="spouse_nik" name="collateral_owner[0][spouse_nik]" type="text" inputmode="numeric" minlength="16" maxlength="16" pattern="[0-9]{16}" placeholder="16-digit spouse NIK">
                                                </div>
                                                <small>Required when collateral owner is Married.</small>
                                            </div>

                                            <div class="collateral-field">
                                                <label>6. Mobile Number <span>*</span></label>
                                                <input data-owner-field="phone" name="collateral_owner[0][phone]" type="tel" inputmode="numeric" required placeholder="Mobile number">
                                            </div>

                                            <div class="collateral-field collateral-field--full">
                                                <label>7. Address <span>*</span></label>
                                                <textarea data-owner-field="address" name="collateral_owner[0][address]" required placeholder="Full owner address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </template>
                        </section>

                        <!-- C. AUTOMATIC SUMMARY -->
                        <section class="new-app-form-card collateral-summary-card">
                            <div class="collateral-section-header collateral-section-header--summary">
                                <div>
                                    <span class="collateral-section-eyebrow">Fields 24–25 · Automatic</span>
                                    <h2>Total Collateral Summary</h2>
                                    <p>Automatic aggregation across every collateral card.</p>
                                </div>

                                <span class="collateral-summary-count" id="collateralSummaryCount">1 Collateral</span>
                            </div>

                            <div class="collateral-summary-grid">
                                <article class="collateral-summary-metric">
                                    <span>Total NJOP</span>
                                    <strong id="collateralTotalNjop">Rp 0</strong>
                                    <small>Sum of current-year NJOP values</small>
                                </article>

                                <article class="collateral-summary-metric">
                                    <span>Total Market Value</span>
                                    <strong id="collateralTotalMarket">Rp 0</strong>
                                    <small>Linked from completed appraisal</small>
                                </article>

                                <article class="collateral-summary-metric">
                                    <span>Total Liquidation Value</span>
                                    <strong id="collateralTotalLiquidation">Rp 0</strong>
                                    <small>Linked from completed appraisal</small>
                                </article>

                                <article class="collateral-summary-metric collateral-summary-metric--coverage">
                                    <span>Total Collateral Cover · MV</span>
                                    <strong id="collateralTotalCoverMv">—</strong>
                                    <small id="collateralTotalCoverMvNote">Waiting for requested plafond</small>
                                </article>

                                <article class="collateral-summary-metric collateral-summary-metric--coverage">
                                    <span>Total Collateral Cover · LV</span>
                                    <strong id="collateralTotalCoverLv">—</strong>
                                    <small id="collateralTotalCoverLvNote">Waiting for requested plafond</small>
                                </article>
                            </div>
                        </section>

                    </div>

                    <footer class="new-app-page-actions">

                        <div class="new-app-page-actions__info">
                            Step 6 of 8 — Collateral &amp; Collateral Owner
                        </div>

                        <div class="new-app-page-actions__buttons">

                            <div class="new-app-draft-control">
                                <button
                                    type="button"
                                    class="new-app-btn new-app-btn--secondary new-app-save-draft"
                                    data-save-draft="collateral">
                                    <i class="fa-regular fa-floppy-disk" aria-hidden="true"></i>
                                    Save as Draft
                                </button>

                                <span class="new-app-draft-time" data-draft-time="collateral">
                                    <i class="fa-regular fa-clock" aria-hidden="true"></i>
                                    <span>Created: — &middot; Last saved: —</span>
                                </span>
                            </div>

                            <a href="#spouseManagement"
                                class="new-app-btn new-app-btn--secondary">
                                <i class="fa-solid fa-arrow-left"></i>
                                Previous
                            </a>

                            <a href="#repayment"
                                class="new-app-btn new-app-btn--primary">
                                Continue
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                        </div>

                    </footer>

                </section>


                <!-- =============================================
             STEP 7 - REPAYMENT INFORMATION
             ============================================= -->
                <section
                    class="new-app-page"
                    id="repayment"
                    data-step="7"
                    hidden>

                    <header class="new-app-page-header">
                        <h1>Repayment Information</h1>

                        <p>
                            Configure repayment schedule, tenor, installment,
                            and payment information.
                        </p>
                    </header>

                    <div class="repayment-capacity-shell" id="repaymentCapacityShell">

                        <section class="repayment-card repayment-card--inputs">
                            <div class="repayment-card__header">
                                <div>
                                    <span class="repayment-card__eyebrow">Repayment Capacity</span>
                                    <h2>Repayment Terms & Capacity Inputs</h2>
                                    <p>
                                        Income and existing obligations are pulled automatically from Employment / Business Information.
                                        Adjust the proposed facility terms below to calculate indicative repayment capacity.
                                    </p>
                                </div>

                                <span class="repayment-auto-badge">
                                    <i class="fa-solid fa-calculator" aria-hidden="true"></i>
                                    Auto Calculated
                                </span>
                            </div>

                            <div class="repayment-source-banner">
                                <i class="fa-solid fa-link" aria-hidden="true"></i>
                                <div>
                                    <strong>Linked from previous steps</strong>
                                    <span>
                                        Monthly income / revenue, other income, spouse income when included,
                                        and existing installment obligations are synchronized automatically.
                                    </span>
                                </div>
                            </div>

                            <div class="repayment-source-grid">
                                <div class="repayment-source-item">
                                    <span>Primary Monthly Income / Revenue</span>
                                    <strong id="repaymentPrimaryIncomeDisplay">Rp 0</strong>
                                    <small>From Employment / Business Information</small>
                                </div>

                                <div class="repayment-source-item">
                                    <span>Other Monthly Income</span>
                                    <strong id="repaymentOtherIncomeDisplay">Rp 0</strong>
                                    <small>From Employment / Business Information</small>
                                </div>

                                <div class="repayment-source-item" id="repaymentSpouseIncomeSource" hidden>
                                    <span>Spouse Monthly Income</span>
                                    <strong id="repaymentSpouseIncomeDisplay">Rp 0</strong>
                                    <small>Included only when selected below</small>
                                </div>

                                <div class="repayment-source-item repayment-source-item--obligation">
                                    <span>Existing Monthly Obligations</span>
                                    <strong id="repaymentExistingObligationsDisplay">Rp 0</strong>
                                    <small>From declared / SLIK-matched obligations</small>
                                </div>
                            </div>

                            <div class="repayment-form-grid">
                                <div class="repayment-field repayment-field--money">
                                    <label for="repaymentRequestedAmount">Requested Loan Amount / Plafond <span>*</span></label>
                                    <div class="repayment-money-control">
                                        <span>Rp</span>
                                        <input
                                            id="repaymentRequestedAmount"
                                            name="repayment_requested_amount"
                                            type="text"
                                            inputmode="numeric"
                                            required
                                            placeholder="0">
                                    </div>
                                    <small>Also updates collateral coverage calculation automatically.</small>
                                </div>

                                <div class="repayment-field">
                                    <label for="repaymentTenorMonths">Tenor <span>*</span></label>
                                    <div class="repayment-suffix-control">
                                        <input
                                            id="repaymentTenorMonths"
                                            name="repayment_tenor_months"
                                            type="number"
                                            min="1"
                                            max="360"
                                            step="1"
                                            required
                                            value="36">
                                        <span>Months</span>
                                    </div>
                                </div>

                                <div class="repayment-field">
                                    <label for="repaymentAnnualRate">Annual Interest Rate <span>*</span></label>
                                    <div class="repayment-suffix-control">
                                        <input
                                            id="repaymentAnnualRate"
                                            name="repayment_annual_rate"
                                            type="number"
                                            min="0"
                                            max="100"
                                            step="0.01"
                                            required
                                            value="12.50">
                                        <span>% p.a.</span>
                                    </div>
                                </div>

                                <div class="repayment-field">
                                    <label for="repaymentMethod">Repayment Method <span>*</span></label>
                                    <select id="repaymentMethod" name="repayment_method" required>
                                        <option value="annuity" selected>Annuity / Effective</option>
                                        <option value="flat">Flat</option>
                                    </select>
                                </div>

                                <div class="repayment-field">
                                    <label for="repaymentMaxDsr">Maximum DSR Policy <span>*</span></label>
                                    <div class="repayment-suffix-control">
                                        <input
                                            id="repaymentMaxDsr"
                                            name="repayment_max_dsr"
                                            type="number"
                                            min="1"
                                            max="100"
                                            step="0.01"
                                            required
                                            value="35">
                                        <span>%</span>
                                    </div>
                                    <small>Recommended as a master-policy parameter, not a hard-coded approval rule.</small>
                                </div>

                                <div class="repayment-field" id="repaymentIncludeSpouseField" hidden>
                                    <label for="repaymentIncludeSpouse">Include Spouse Income</label>
                                    <select id="repaymentIncludeSpouse" name="repayment_include_spouse_income">
                                        <option value="no" selected>No</option>
                                        <option value="yes">Yes</option>
                                    </select>
                                    <small>Use only when spouse income is allowed for repayment assessment.</small>
                                </div>
                            </div>

                            <div class="repayment-policy-note" id="repaymentBusinessBasisNote" hidden>
                                <i class="fa-solid fa-circle-info" aria-hidden="true"></i>
                                <div>
                                    <strong>Business Entity calculation basis</strong>
                                    <span>
                                        The current prototype uses Monthly Income / Revenue from Step 4.
                                        For production underwriting, replace or verify this basis with net operating cash flow / EBITDA or another approved master-policy measure.
                                    </span>
                                </div>
                            </div>
                        </section>

                        <section class="repayment-card repayment-card--result" aria-live="polite">
                            <div class="repayment-result-header">
                                <div>
                                    <span class="repayment-card__eyebrow">Automatic Assessment</span>
                                    <h2>Repayment Capacity Result</h2>
                                    <p>Indicative capacity only. Final approval remains subject to verified data and credit policy.</p>
                                </div>

                                <span class="repayment-status repayment-status--neutral" id="repaymentCapacityStatus">
                                    <i class="fa-regular fa-clock" aria-hidden="true"></i>
                                    Waiting for Data
                                </span>
                            </div>

                            <div class="repayment-kpi-grid">
                                <div class="repayment-kpi repayment-kpi--primary">
                                    <span>Estimated Monthly Installment</span>
                                    <strong id="repaymentEstimatedInstallment">Rp 0</strong>
                                    <small>Based on proposed amount, tenor, rate & method</small>
                                </div>

                                <div class="repayment-kpi">
                                    <span>Maximum New Installment</span>
                                    <strong id="repaymentMaxNewInstallment">Rp 0</strong>
                                    <small>Based on DSR policy after existing obligations</small>
                                </div>

                                <div class="repayment-kpi">
                                    <span>DSR After Proposed Loan</span>
                                    <strong id="repaymentDsrAfter">0.00%</strong>
                                    <small id="repaymentDsrLimitLabel">Policy limit: 35.00%</small>
                                </div>

                                <div class="repayment-kpi">
                                    <span>Disposable Income After Debt</span>
                                    <strong id="repaymentDisposableIncome">Rp 0</strong>
                                    <small>Assessable income minus total debt service</small>
                                </div>
                            </div>

                            <div class="repayment-utilization">
                                <div class="repayment-utilization__head">
                                    <div>
                                        <span>Repayment Capacity Utilization</span>
                                        <strong id="repaymentCapacityUtilization">0.00%</strong>
                                    </div>
                                    <span id="repaymentCapacityHeadroom">Headroom: Rp 0</span>
                                </div>

                                <div class="repayment-utilization__track" aria-hidden="true">
                                    <span id="repaymentCapacityFill"></span>
                                </div>
                            </div>

                            <div class="repayment-breakdown">
                                <div class="repayment-breakdown__row">
                                    <span>Assessable Monthly Income</span>
                                    <strong id="repaymentAssessableIncome">Rp 0</strong>
                                </div>

                                <div class="repayment-breakdown__row">
                                    <span>Existing Monthly Obligations</span>
                                    <strong id="repaymentExistingObligationsResult">Rp 0</strong>
                                </div>

                                <div class="repayment-breakdown__row">
                                    <span>DSR Before Proposed Loan</span>
                                    <strong id="repaymentDsrBefore">0.00%</strong>
                                </div>

                                <div class="repayment-breakdown__row">
                                    <span>Total Monthly Debt Service</span>
                                    <strong id="repaymentTotalDebtService">Rp 0</strong>
                                </div>

                                <div class="repayment-breakdown__row repayment-breakdown__row--highlight">
                                    <span>Recommended Maximum Loan Amount</span>
                                    <strong id="repaymentRecommendedMaxLoan">Rp 0</strong>
                                </div>
                            </div>

                            <div class="repayment-formula-box">
                                <strong><i class="fa-solid fa-calculator" aria-hidden="true"></i> Calculation logic</strong>
                                <span>Assessable income = primary income + other income + included spouse income.</span>
                                <span>Max new installment = (assessable income × DSR limit) − existing obligations.</span>
                                <span>DSR after = (existing obligations + proposed installment) ÷ assessable income × 100%.</span>
                            </div>

                            <input type="hidden" id="repaymentPrimaryIncome" name="repayment_primary_income" value="0">
                            <input type="hidden" id="repaymentOtherIncome" name="repayment_other_income" value="0">
                            <input type="hidden" id="repaymentSpouseIncome" name="repayment_spouse_income" value="0">
                            <input type="hidden" id="repaymentExistingObligations" name="repayment_existing_obligations" value="0">
                            <input type="hidden" id="repaymentAssessableIncomeValue" name="repayment_assessable_income" value="0">
                            <input type="hidden" id="repaymentEstimatedInstallmentValue" name="repayment_estimated_installment" value="0">
                            <input type="hidden" id="repaymentMaxNewInstallmentValue" name="repayment_max_new_installment" value="0">
                            <input type="hidden" id="repaymentTotalDebtServiceValue" name="repayment_total_debt_service" value="0">
                            <input type="hidden" id="repaymentDisposableIncomeValue" name="repayment_disposable_income" value="0">
                            <input type="hidden" id="repaymentDsrBeforeValue" name="repayment_dsr_before" value="0">
                            <input type="hidden" id="repaymentDsrAfterValue" name="repayment_dsr_after" value="0">
                            <input type="hidden" id="repaymentCapacityHeadroomValue" name="repayment_capacity_headroom" value="0">
                            <input type="hidden" id="repaymentRecommendedMaxLoanValue" name="repayment_recommended_max_loan" value="0">
                            <input type="hidden" id="repaymentCapacityStatusValue" name="repayment_capacity_status" value="waiting">
                        </section>

                    </div>

                    <footer class="new-app-page-actions">

                        <div class="new-app-page-actions__info">
                            Step 7 of 8 — Repayment Information
                        </div>

                        <div class="new-app-page-actions__buttons">

                            <div class="new-app-draft-control">
                                <button
                                    type="button"
                                    class="new-app-btn new-app-btn--secondary new-app-save-draft"
                                    data-save-draft="repayment">
                                    <i class="fa-regular fa-floppy-disk" aria-hidden="true"></i>
                                    Save as Draft
                                </button>

                                <span class="new-app-draft-time" data-draft-time="repayment">
                                    <i class="fa-regular fa-clock" aria-hidden="true"></i>
                                    <span>Created: — &middot; Last saved: —</span>
                                </span>
                            </div>


                            <a href="#collateral"
                                class="new-app-btn new-app-btn--secondary">
                                <i class="fa-solid fa-arrow-left"></i>
                                Previous
                            </a>

                            <a href="#reviewSubmit"
                                class="new-app-btn new-app-btn--primary">
                                Review Application
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                        </div>

                    </footer>

                </section>



                <!-- =============================================
             STEP 8 - REVIEW & SUBMIT
             ============================================= -->
                <section
                    class="new-app-page"
                    id="reviewSubmit"
                    data-step="8"
                    hidden>

                    <header class="new-app-page-header review-submit-header">
                        <div>
                            <h1>Review &amp; Submit</h1>
                            <p>
                                Review the complete application, resolve all missing required items,
                                add Marketing notes, then submit to Credit Analyst &amp; Appraisal.
                            </p>
                        </div>

                        <span class="review-readiness-badge review-readiness-badge--pending" id="reviewReadinessBadge">
                            <i class="fa-regular fa-clock" aria-hidden="true"></i>
                            Checking completeness
                        </span>
                    </header>

                    <!-- Returned application notice. Hidden for a new application. -->
                    <section class="review-returned-notice" id="reviewReturnedNotice" hidden>
                        <div class="review-returned-notice__icon">
                            <i class="fa-solid fa-arrow-rotate-left" aria-hidden="true"></i>
                        </div>
                        <div class="review-returned-notice__body">
                            <span class="review-returned-notice__eyebrow">Returned by Credit Analyst</span>
                            <strong>Revision is required before resubmission.</strong>
                            <p id="reviewReturnedMessage"></p>
                            <div class="review-returned-items" id="reviewReturnedItems"></div>
                        </div>
                    </section>

                    <div class="review-submit-stack">

                        <!-- Completeness overview -->
                        <section class="review-overview-card">
                            <div class="review-section-heading">
                                <div>
                                    <span class="review-section-heading__eyebrow">Application Readiness</span>
                                    <h2>Completeness Overview</h2>
                                    <p>Submit is enabled only when all currently applicable required fields and documents are complete.</p>
                                </div>
                            </div>

                            <div class="review-readiness-grid">
                                <article class="review-readiness-stat">
                                    <span>Sections</span>
                                    <strong id="reviewSectionCount">7</strong>
                                    <small>Application sections reviewed</small>
                                </article>

                                <article class="review-readiness-stat review-readiness-stat--success">
                                    <span>Complete Fields</span>
                                    <strong id="reviewCompleteFieldCount">0</strong>
                                    <small>Required fields completed</small>
                                </article>

                                <article class="review-readiness-stat review-readiness-stat--danger">
                                    <span>Missing Fields</span>
                                    <strong id="reviewMissingFieldCount">0</strong>
                                    <small>Required fields still incomplete</small>
                                </article>

                                <article class="review-readiness-stat review-readiness-stat--danger">
                                    <span>Missing Documents</span>
                                    <strong id="reviewMissingDocumentCount">0</strong>
                                    <small>Required documents still missing</small>
                                </article>
                            </div>
                        </section>

                        <!-- Read-only summary per section -->
                        <section class="review-summary-shell" aria-labelledby="reviewSummaryTitle">
                            <div class="review-section-heading">
                                <div>
                                    <span class="review-section-heading__eyebrow">Read-only Summary</span>
                                    <h2 id="reviewSummaryTitle">Application Summary by Section</h2>
                                    <p>Use Edit to return directly to the related step without losing the current draft.</p>
                                </div>
                            </div>

                            <div class="review-summary-grid">
                                <article class="review-summary-card" data-review-card="applicationData">
                                    <header>
                                        <div class="review-summary-card__title">
                                            <span class="review-summary-card__icon"><i class="fa-regular fa-file-lines"></i></span>
                                            <div><strong>Application Data</strong><small>Step 1</small></div>
                                        </div>
                                        <a href="#applicationData" class="review-edit-link"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                    </header>
                                    <dl class="review-summary-list" id="reviewSummaryApplication"></dl>
                                </article>

                                <article class="review-summary-card" data-review-card="docUpload">
                                    <header>
                                        <div class="review-summary-card__title">
                                            <span class="review-summary-card__icon"><i class="fa-solid fa-cloud-arrow-up"></i></span>
                                            <div><strong>Document Upload</strong><small>Step 2</small></div>
                                        </div>
                                        <a href="#docUpload" class="review-edit-link"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                    </header>
                                    <dl class="review-summary-list" id="reviewSummaryDocuments"></dl>
                                </article>

                                <article class="review-summary-card" data-review-card="borrowerData">
                                    <header>
                                        <div class="review-summary-card__title">
                                            <span class="review-summary-card__icon"><i class="fa-regular fa-user"></i></span>
                                            <div><strong>Borrower Data</strong><small>Step 3</small></div>
                                        </div>
                                        <a href="#borrowerData" class="review-edit-link"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                    </header>
                                    <dl class="review-summary-list" id="reviewSummaryBorrower"></dl>
                                </article>

                                <article class="review-summary-card" data-review-card="employmentBusiness">
                                    <header>
                                        <div class="review-summary-card__title">
                                            <span class="review-summary-card__icon"><i class="fa-solid fa-briefcase"></i></span>
                                            <div><strong>Employment / Business</strong><small>Step 4</small></div>
                                        </div>
                                        <a href="#employmentBusiness" class="review-edit-link"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                    </header>
                                    <dl class="review-summary-list" id="reviewSummaryEmployment"></dl>
                                </article>

                                <article class="review-summary-card" data-review-card="spouseManagement">
                                    <header>
                                        <div class="review-summary-card__title">
                                            <span class="review-summary-card__icon"><i class="fa-solid fa-people-group"></i></span>
                                            <div><strong>Spouse / Management</strong><small>Step 5</small></div>
                                        </div>
                                        <a href="#spouseManagement" class="review-edit-link"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                    </header>
                                    <dl class="review-summary-list" id="reviewSummaryRelatedParties"></dl>
                                </article>

                                <article class="review-summary-card" data-review-card="collateral">
                                    <header>
                                        <div class="review-summary-card__title">
                                            <span class="review-summary-card__icon"><i class="fa-solid fa-building-shield"></i></span>
                                            <div><strong>Collateral</strong><small>Step 6</small></div>
                                        </div>
                                        <a href="#collateral" class="review-edit-link"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                    </header>
                                    <dl class="review-summary-list" id="reviewSummaryCollateral"></dl>
                                </article>

                                <article class="review-summary-card review-summary-card--wide" data-review-card="repayment">
                                    <header>
                                        <div class="review-summary-card__title">
                                            <span class="review-summary-card__icon"><i class="fa-solid fa-calculator"></i></span>
                                            <div><strong>Repayment Information</strong><small>Step 7</small></div>
                                        </div>
                                        <a href="#repayment" class="review-edit-link"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                    </header>
                                    <dl class="review-summary-list review-summary-list--columns" id="reviewSummaryRepayment"></dl>
                                </article>
                            </div>
                        </section>

                        <!-- Completeness checklist -->
                        <section class="review-checklist-card">
                            <div class="review-section-heading review-section-heading--split">
                                <div>
                                    <span class="review-section-heading__eyebrow">Completeness Checklist</span>
                                    <h2>Required Items</h2>
                                    <p>Missing fields and required documents are listed here automatically.</p>
                                </div>
                                <span class="review-checklist-status" id="reviewChecklistStatus">Checking...</span>
                            </div>

                            <div class="review-checklist-columns">
                                <div class="review-checklist-group">
                                    <div class="review-checklist-group__head">
                                        <span><i class="fa-regular fa-rectangle-list"></i> Required Fields</span>
                                        <strong id="reviewFieldChecklistCount">0 missing</strong>
                                    </div>
                                    <div class="review-checklist-list" id="reviewMissingFieldsList"></div>
                                </div>

                                <div class="review-checklist-group">
                                    <div class="review-checklist-group__head">
                                        <span><i class="fa-regular fa-folder-open"></i> Required Documents</span>
                                        <strong id="reviewDocumentChecklistCount">0 missing</strong>
                                    </div>
                                    <div class="review-checklist-list" id="reviewMissingDocumentsList"></div>
                                </div>
                            </div>
                        </section>

                        <!-- Marketing note -->
                        <section class="review-marketing-card">
                            <div class="review-section-heading">
                                <div>
                                    <span class="review-section-heading__eyebrow">Marketing Note</span>
                                    <h2>Additional Information for Appraisal &amp; Credit Analyst</h2>
                                    <p>Optional. Add context that will help Appraisal and Credit Analyst review the application.</p>
                                </div>
                            </div>

                            <label class="review-marketing-note" for="reviewMarketingNote">
                                <span>Marketing Notes</span>
                                <textarea
                                    id="reviewMarketingNote"
                                    name="marketing_review_note"
                                    rows="5"
                                    maxlength="2000"
                                    placeholder="Add additional application context, property access information, business background, or other notes for Appraisal & Credit Analyst..."></textarea>
                                <small><span id="reviewMarketingNoteCount">0</span>/2000 characters</small>
                            </label>
                        </section>

                    </div>

                    <footer class="new-app-page-actions review-submit-actions">

                        <div class="new-app-page-actions__info">
                            Step 8 of 8 — Review &amp; Submit
                        </div>

                        <div class="new-app-page-actions__buttons">
                            <div class="new-app-draft-control">
                                <button
                                    type="button"
                                    class="new-app-btn new-app-btn--secondary new-app-save-draft"
                                    data-save-draft="reviewSubmit">
                                    <i class="fa-regular fa-floppy-disk" aria-hidden="true"></i>
                                    Save as Draft
                                </button>

                                <span class="new-app-draft-time" data-draft-time="reviewSubmit">
                                    <i class="fa-regular fa-clock" aria-hidden="true"></i>
                                    <span>Created: — &middot; Last saved: —</span>
                                </span>
                            </div>

                            <a href="#repayment" class="new-app-btn new-app-btn--secondary">
                                <i class="fa-solid fa-arrow-left"></i>
                                Previous
                            </a>

                            <button type="button" class="new-app-btn review-cancel-button" id="cancelApplicationButton">
                                <i class="fa-regular fa-circle-xmark"></i>
                                Cancel Application
                            </button>

                            <button
                                type="button"
                                class="new-app-btn new-app-btn--primary review-submit-button"
                                id="submitApplicationButton"
                                disabled>
                                Submit to Analyst &amp; Appraisal
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </footer>

                </section>


            </div>

        </div>
    </main>



    <!-- =====================================================
         REVIEW & SUBMIT MODALS
         ===================================================== -->
    <div class="review-action-modal" id="submitSuccessModal" hidden
         data-redirect="<?= base_url('app-list') ?>">
        <div class="review-action-modal__backdrop" aria-hidden="true"></div>
        <section class="review-action-modal__dialog review-action-modal__dialog--success"
                 role="dialog" aria-modal="true" aria-labelledby="submitSuccessTitle">
            <div class="review-success-icon"><i class="fa-solid fa-check"></i></div>
            <span class="review-action-modal__eyebrow">Application Submitted</span>
            <h2 id="submitSuccessTitle">Submitted Successfully</h2>
            <p>
                The application has been submitted to Credit Analyst &amp; Appraisal.
                The application is now locked for Marketing while the review tasks are created.
            </p>

            <div class="review-success-reference">
                <span>Application No.</span>
                <strong id="submitSuccessApplicationNo">—</strong>
            </div>

            <div class="review-success-route">
                <i class="fa-solid fa-diagram-project"></i>
                <div>
                    <strong>Next workflow</strong>
                    <span>Appraisal (M03) + Credit Analysis (M04)</span>
                </div>
            </div>

            <p class="review-success-countdown">
                Redirecting to Application List in <strong id="submitRedirectCountdown">3</strong> seconds...
            </p>

            <button type="button" class="new-app-btn new-app-btn--primary" id="submitGoToListButton">
                Go to Application List
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </section>
    </div>

    <div class="review-action-modal" id="cancelApplicationModal" hidden
         data-redirect="<?= base_url('app-list') ?>">
        <button type="button" class="review-action-modal__backdrop" data-cancel-modal-close aria-label="Close cancel dialog"></button>
        <section class="review-action-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="cancelApplicationTitle">
            <div class="review-cancel-icon"><i class="fa-regular fa-circle-xmark"></i></div>
            <span class="review-action-modal__eyebrow">Cancel Application</span>
            <h2 id="cancelApplicationTitle">Reason is required</h2>
            <p>Cancelling will stop this application from continuing to Analyst &amp; Appraisal.</p>

            <label class="review-cancel-reason" for="cancelApplicationReason">
                <span>Cancellation Reason <b>*</b></span>
                <textarea id="cancelApplicationReason" rows="4" maxlength="1000" placeholder="Explain why this application is being cancelled..."></textarea>
                <small id="cancelApplicationError" hidden>Please enter a cancellation reason.</small>
            </label>

            <div class="review-action-modal__actions">
                <button type="button" class="new-app-btn new-app-btn--secondary" data-cancel-modal-close>Keep Application</button>
                <button type="button" class="new-app-btn review-cancel-confirm" id="confirmCancelApplication">
                    Cancel Application
                </button>
            </div>
        </section>
    </div>

    <!-- =====================================================
         DOCUMENT IMAGE PREVIEW - SELF-CONTAINED VIEWER
         Uses the already rendered thumbnail src, so it does not depend
         on the legacy preview modal implementation in main.js/main.css.
         ===================================================== -->
    <div class="aggre-image-viewer" id="aggreImageViewer" aria-hidden="true">
        <button
            type="button"
            class="aggre-image-viewer__backdrop"
            data-aggre-preview-close
            aria-label="Close image preview"></button>

        <section
            class="aggre-image-viewer__panel"
            role="dialog"
            aria-modal="true"
            aria-labelledby="aggreImageViewerTitle">

            <header class="aggre-image-viewer__header">
                <div class="aggre-image-viewer__title">
                    <span class="aggre-image-viewer__eyebrow">Image Preview</span>
                    <h2 id="aggreImageViewerTitle">Document Image</h2>
                </div>

                <button
                    type="button"
                    class="aggre-image-viewer__close"
                    data-aggre-preview-close
                    aria-label="Close image preview">
                    <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                </button>
            </header>

            <div class="aggre-image-viewer__stage">
                <div class="aggre-image-viewer__status" id="aggreImageViewerStatus">
                    Loading image preview...
                </div>

                <img
                    class="aggre-image-viewer__image"
                    id="aggreImageViewerImage"
                    alt="Document preview"
                    draggable="false">
            </div>

            <footer class="aggre-image-viewer__footer">
                <span>JPG / JPEG / PNG preview</span>
                <span>Press Esc or click outside the viewer to close</span>
            </footer>
        </section>
    </div>

    <script src="<?= base_url('assets/js/sidebar.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>

    <script>
        (function () {
            const viewer = document.getElementById('aggreImageViewer');
            const viewerImage = document.getElementById('aggreImageViewerImage');
            const viewerTitle = document.getElementById('aggreImageViewerTitle');
            const viewerStatus = document.getElementById('aggreImageViewerStatus');

            if (!viewer || !viewerImage || !viewerTitle || !viewerStatus) return;

            let lastFocusedElement = null;

            function findPreviewImage(trigger) {
                if (!trigger) return null;

                if (trigger.matches('.doc-checklist-file__preview')) {
                    return trigger.querySelector('img');
                }

                const fileCard = trigger.closest('.doc-checklist-file');
                if (!fileCard) return null;

                return fileCard.querySelector('.doc-checklist-file__preview img');
            }

            function findFileName(trigger, image) {
                const fileCard = trigger?.closest('.doc-checklist-file');
                const name = fileCard?.querySelector('.doc-checklist-file__header strong')?.textContent?.trim();
                return name || image?.alt || 'Document Image';
            }

            function openViewer(image, title) {
                if (!image) return;

                const source = image.currentSrc || image.src;
                if (!source) return;

                lastFocusedElement = document.activeElement;

                viewer.classList.remove('has-error');
                viewer.classList.add('is-open', 'is-loading');
                viewer.setAttribute('aria-hidden', 'false');
                document.body.classList.add('aggre-image-viewer-open');

                viewerTitle.textContent = title || 'Document Image';
                viewerStatus.textContent = 'Loading image preview...';

                // Clear first so loading the same blob URL still fires reliably.
                viewerImage.removeAttribute('src');

                viewerImage.onload = function () {
                    viewer.classList.remove('is-loading', 'has-error');
                };

                viewerImage.onerror = function () {
                    viewer.classList.remove('is-loading');
                    viewer.classList.add('has-error');
                    viewerStatus.textContent = 'Image preview could not be displayed. Please use Replace and upload the image again.';
                };

                // Use the thumbnail's already-working URL. This avoids recreating
                // or losing the Blob URL that main.js generated for the upload.
                viewerImage.src = source;

                // Cached blob/data images can already be complete before onload executes.
                if (viewerImage.complete && viewerImage.naturalWidth > 0) {
                    viewer.classList.remove('is-loading', 'has-error');
                }

                window.requestAnimationFrame(function () {
                    viewer.querySelector('.aggre-image-viewer__close')?.focus({ preventScroll: true });
                });
            }

            function closeViewer() {
                if (!viewer.classList.contains('is-open')) return;

                viewer.classList.remove('is-open', 'is-loading', 'has-error');
                viewer.setAttribute('aria-hidden', 'true');
                document.body.classList.remove('aggre-image-viewer-open');

                viewerImage.onload = null;
                viewerImage.onerror = null;
                viewerImage.removeAttribute('src');

                if (lastFocusedElement && typeof lastFocusedElement.focus === 'function') {
                    lastFocusedElement.focus({ preventScroll: true });
                }
            }

            // Capture phase intentionally runs before legacy click handlers in main.js.
            document.addEventListener('click', function (event) {
                const closeButton = event.target.closest('[data-aggre-preview-close]');
                if (closeButton) {
                    event.preventDefault();
                    event.stopImmediatePropagation();
                    closeViewer();
                    return;
                }

                const previewThumb = event.target.closest('.doc-checklist-file__preview');
                const action = event.target.closest('.doc-checklist-file__action');
                const isImagePreviewAction = action && /preview/i.test(action.textContent || '');
                const trigger = previewThumb || (isImagePreviewAction ? action : null);

                if (!trigger) return;

                const image = findPreviewImage(trigger);
                if (!image) return; // PDF has no image thumbnail: keep its normal new-tab behavior.

                event.preventDefault();
                event.stopImmediatePropagation();

                openViewer(image, findFileName(trigger, image));
            }, true);

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && viewer.classList.contains('is-open')) {
                    event.preventDefault();
                    closeViewer();
                }
            });
        })();
    </script>

</body>

</html>
