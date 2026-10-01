document.addEventListener("DOMContentLoaded", function () {

    /* =========================
       ELEMENTS
       ========================= */
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const mobileSidebarToggle = document.getElementById("mobileSidebarToggle");
    const sidebarOverlay = document.getElementById("sidebarOverlay");

    const menuParents = document.querySelectorAll(".menu-parent");
    const normalMenus = document.querySelectorAll(
        ".sidebar-menu-item:not(.menu-parent)"
    );
    const submenuItems = document.querySelectorAll(".sidebar-submenu-item");


    /* =========================
       REMOVE ACTIVE
       ========================= */
    function removeAllActive() {

        document
            .querySelectorAll(
                ".sidebar-menu-item, .sidebar-submenu-item"
            )
            .forEach(function (item) {

                item.classList.remove("active");

            });
    }


    /* =========================
       NORMALIZE URL
       ========================= */
    function normalizePath(pathname) {

        const path = pathname.replace(/\/+$/, "");

        return path || "/";
    }


    /* =========================
       ACTIVE MENU BASED ON URL
       ========================= */
    function setActiveMenuFromUrl() {

        const currentPath = normalizePath(
            window.location.pathname
        );

        let activeItem = null;


        document
            .querySelectorAll(
                ".sidebar-menu-item:not(.menu-parent)[href], " +
                ".sidebar-submenu-item[href]"
            )
            .forEach(function (item) {

                const href = item.getAttribute("href");


                if (
                    !href ||
                    href === "#" ||
                    href.startsWith("javascript:")
                ) {
                    return;
                }


                const itemUrl = new URL(
                    href,
                    window.location.href
                );


                const itemPath = normalizePath(
                    itemUrl.pathname
                );


                if (itemPath === currentPath) {

                    activeItem = item;

                }

            });


        if (!activeItem) {
            return;
        }


        removeAllActive();


        /*
         * Aktifkan menu yang URL-nya
         * sama dengan halaman sekarang
         */
        activeItem.classList.add("active");


        /*
         * Kalau activeItem merupakan submenu,
         * buka parent menu-nya juga
         */
        const submenu = activeItem.closest(
            ".sidebar-submenu"
        );


        if (submenu) {

            submenu.classList.add("open");


            const submenuId =
                submenu.getAttribute("id");


            const parent =
                document.querySelector(
                    '[data-submenu="' +
                    submenuId +
                    '"]'
                );


            if (parent) {

                parent.classList.add(
                    "active",
                    "open"
                );

            }

        }

    }


    /* =========================
       CHECK MOBILE
       ========================= */
    function isMobile() {

        return window.innerWidth < 768;

    }


    /* =========================
       OPEN MOBILE SIDEBAR
       ========================= */
    function openMobileSidebar() {

        if (!sidebar) {
            return;
        }


        sidebar.classList.add(
            "mobile-open"
        );


        if (sidebarOverlay) {

            sidebarOverlay.classList.add(
                "active"
            );

        }


        if (mobileSidebarToggle) {

            mobileSidebarToggle.classList.add(
                "active"
            );


            mobileSidebarToggle.setAttribute(
                "aria-expanded",
                "true"
            );


            mobileSidebarToggle.setAttribute(
                "aria-label",
                "Close sidebar"
            );


            const icon =
                mobileSidebarToggle.querySelector("i");


            if (icon) {

                icon.className =
                    "fa-solid fa-xmark";

            }

        }


        /*
         * Body tidak scroll ketika
         * sidebar mobile terbuka
         */
        document.body.style.overflow =
            "hidden";

    }


    /* =========================
       CLOSE MOBILE SIDEBAR
       ========================= */
    function closeMobileSidebar() {

        if (!sidebar) {
            return;
        }


        sidebar.classList.remove(
            "mobile-open"
        );


        if (sidebarOverlay) {

            sidebarOverlay.classList.remove(
                "active"
            );

        }


        if (mobileSidebarToggle) {

            mobileSidebarToggle.classList.remove(
                "active"
            );


            mobileSidebarToggle.setAttribute(
                "aria-expanded",
                "false"
            );


            mobileSidebarToggle.setAttribute(
                "aria-label",
                "Open sidebar"
            );


            const icon =
                mobileSidebarToggle.querySelector("i");


            if (icon) {

                icon.className =
                    "fa-solid fa-bars";

            }

        }


        document.body.style.overflow = "";

    }


    /* =========================
       DROPDOWN MENU
       ========================= */

    menuParents.forEach(function (parent) {

        parent.addEventListener(
            "click",
            function (event) {

                /*
                 * HANYA parent dropdown
                 * yang menggunakan preventDefault.
                 *
                 * Jadi Loan Applications
                 * tidak pindah halaman,
                 * tetapi membuka submenu.
                 */
                event.preventDefault();


                const submenuId =
                    this.getAttribute(
                        "data-submenu"
                    );


                const submenu =
                    document.getElementById(
                        submenuId
                    );


                if (!submenu) {
                    return;
                }


                /*
                 * Toggle submenu
                 */
                submenu.classList.toggle(
                    "open"
                );


                /*
                 * Toggle parent
                 */
                this.classList.toggle(
                    "open"
                );

            }
        );

    });


    /* =========================
       NORMAL MENU
       ========================= */

    normalMenus.forEach(function (item) {

        item.addEventListener(
            "click",
            function () {

                /*
                 * TIDAK menggunakan:
                 *
                 * event.preventDefault()
                 *
                 * sehingga href akan
                 * langsung bekerja.
                 *
                 * contoh:
                 *
                 * dashboard.php
                 * credit-analysis.php
                 * lender.php
                 * dll.
                 */


                if (isMobile()) {

                    closeMobileSidebar();

                }

            }
        );

    });


    /* =========================
       SUBMENU
       ========================= */

    submenuItems.forEach(function (item) {

        item.addEventListener(
            "click",
            function () {

                /*
                 * Jangan pakai
                 * event.preventDefault()
                 *
                 * supaya:
                 *
                 * loan-application.php
                 * new-application.php
                 * draft-application.php
                 *
                 * bisa langsung dibuka.
                 */


                if (isMobile()) {

                    closeMobileSidebar();

                }

            }
        );

    });


    /* =========================
       SIDEBAR COLLAPSE
       ========================= */

    if (sidebar && sidebarToggle) {

        sidebarToggle.addEventListener(
            "click",
            function () {


                sidebar.classList.toggle(
                    "collapsed"
                );


                const isCollapsed =
                    sidebar.classList.contains(
                        "collapsed"
                    );


                /*
                 * Accessibility
                 */
                sidebarToggle.setAttribute(
                    "aria-expanded",
                    (!isCollapsed).toString()
                );


                sidebarToggle.setAttribute(
                    "aria-label",
                    isCollapsed
                        ? "Expand sidebar"
                        : "Collapse sidebar"
                );


                /*
                 * Kalau sidebar collapse,
                 * tutup semua submenu
                 */
                if (isCollapsed) {

                    document
                        .querySelectorAll(
                            ".sidebar-submenu.open"
                        )
                        .forEach(
                            function (submenu) {

                                submenu
                                    .classList
                                    .remove("open");

                            }
                        );


                    document
                        .querySelectorAll(
                            ".menu-parent.open"
                        )
                        .forEach(
                            function (parent) {

                                parent
                                    .classList
                                    .remove("open");

                            }
                        );

                }

            }
        );

    }


    /* =========================
       MOBILE SIDEBAR TOGGLE
       ========================= */

    if (mobileSidebarToggle) {

        mobileSidebarToggle
            .addEventListener(
                "click",
                function () {


                    if (!sidebar) {
                        return;
                    }


                    const isOpen =
                        sidebar.classList.contains(
                            "mobile-open"
                        );


                    if (isOpen) {

                        closeMobileSidebar();

                    } else {

                        openMobileSidebar();

                    }

                }
            );

    }


    /* =========================
       MOBILE OVERLAY
       ========================= */

    if (sidebarOverlay) {

        sidebarOverlay.addEventListener(
            "click",
            closeMobileSidebar
        );

    }


    /* =========================
       ESC CLOSE SIDEBAR
       ========================= */

    document.addEventListener(
        "keydown",
        function (event) {


            if (
                event.key === "Escape" &&
                sidebar &&
                sidebar.classList.contains(
                    "mobile-open"
                )
            ) {

                closeMobileSidebar();

            }

        }
    );


    /* =========================
       WINDOW RESIZE
       ========================= */

    window.addEventListener(
        "resize",
        function () {


            if (!isMobile()) {

                closeMobileSidebar();

            }

        }
    );


    /* =========================
       SET ACTIVE MENU
       ========================= */

    setActiveMenuFromUrl();

});