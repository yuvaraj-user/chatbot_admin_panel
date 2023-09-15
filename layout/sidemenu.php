<body data-sidebar="dark">

<!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="#" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="https://www.mazenet.com/dmt/assets/images/logo-icon.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="https://www.mazenet.com/dmt/assets/images/logo-white.png" alt="" height="25">
                            </span>
                        </a>

                        <a href="#" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="https://www.mazenet.com/dmt/assets/images/logo-icon.png" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="https://www.mazenet.com/dmt/assets/images/logo-white.png" alt="" height="25">
                            </span>
                        </a>
                    </div>
                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                </div>

                <div class="d-flex">    
                    


                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                            <i class="bx bx-fullscreen"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.jpg"
                                alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1" key="t-henry">Admin</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item text-danger" href="code/logout.php"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                            <i class="bx bx-cog bx-spin"></i>
                        </button>
                    </div>


                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title" key="t-menu">Menu</li>

                        <li>
                            <a href="dashboard.php" class="waves-effect">
                                <i class="bx bx-home-circle"></i>
                                <span key="t-dashboards">Dashboards</span>
                            </a>
                        </li>

                     

                        <li style="display:none;" >
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-store"></i>
                                <span key="t-ecommerce">Page Lead Details</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="mazenet-lead.php" key="t-product-detail">MAZENET</a></li>
                                <li><a href="mazenet-contact.php" key="t-product-detail">MAZENET Contact</a></li>
                                <li><a href="mazenet-lms.php" key="t-product-detail">MAZENET LMS</a></li>
                                <li><a href="mazenet-partner.php" key="t-product-detail">MAZENET BECOME A PARTNER</a></li>
                                <li><a href="mazenet-corporate.php" key="t-product-detail">CORPORATE</a></li>
                                <li><a href="mazenet-webinar.php" key="t-product-detail">CORPORATE WEBINAR</a></li>
                                <li><a href="mazenet-b2bpopup.php" key="t-product-detail">TNH - B2B (for-enterprises) Popup </a></li>
                                <li><a href="mazenet-b2b.php" key="t-product-detail">TNH - B2B (for-enterprises) </a></li>
                                <li><a href="mazenet-b2bjcpopup.php" key="t-product-detail">TNH - B2B (For Job Seekers) Popup</a></li>
                                <li><a href="mazenet-lead.php" key="t-product-detail">TNH - B2B (For Job Seekers) </a></li>
                                <li><a href="mazenet-lead.php" key="t-product-detail">TNH - MENDIX </a></li>
                                <li><a href="mazenet-lead.php" key="t-product-detail">TNH - ESRI UNM </a></li>
                                <li><a href="mazenet-lead.php" key="t-product-detail">TNH - SAILPOINT </a></li>
                                <li><a href="mazenet-lead.php" key="t-product-detail">TNH - GOOGLE ADS JOBS </a></li>
                                <li><a href="mazenet-lead.php" key="t-product-detail">STAFFING </a></li>
                                <li><a href="mazenet-lead.php" key="t-product-detail">LAB AS SERVICES </a></li>
                            </ul>
                        </li>
						
						 <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-store"></i>
                                <span key="t-ecommerce">Search</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="search_key.php" key="t-product-detail">Search Keywords</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="chat_history.php">
                                <i class="bx bx-chat"></i>
                                <span >Chatbot history</span>
                            </a>
                        </li>
						
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        