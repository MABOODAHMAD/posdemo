<?php 
$sesData = sessionUserData();
?>
<!doctype html>
<html lang="en">
<head>
        
        <meta charset="utf-8" />
        <title><?=headerTitle()?headerTitle():'MOM'?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Al Moallim Jewellery | Ring, Necklace, Diamond" name="description" />
        <meta content="Al Moallim Jewellery" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?=base_url()?>assets/images/favicon.ico">

        <link href="<?=base_url()?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- DataTables -->
        <link href="<?=base_url()?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="<?=base_url()?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />     

        <!-- Sweet Alert-->
        <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
        
        <link href="<?=base_url()?>assets/libs/tui-chart/tui-chart.min.css" rel="stylesheet" type="text/css" />


        <!-- Bootstrap Css -->
        <link href="<?=base_url()?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?=base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?=base_url()?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <!--=============================== Auto Autocomplete =============================-->

        <link href="<?=base_url()?>assets/css/custom_css/jquery-ui-1.9.2.custom.css" rel="stylesheet">

        <!-- Plugins css Bulk Upload-->
        <link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
        
        <!-- <noscript>
            <meta http-equiv="refresh" runat="server" id="mtaJSCheck" content="0;<?=base_url()?>" />
        </noscript> -->
    </head>

    <body data-sidebar="dark" data-layout-mode="light">
         <div id="preloader">
            <div id="status">
                <div class="spinner-chase">
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                    <div class="chase-dot"></div>
                </div>
            </div>
        </div>
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box" style="padding: unset;">
                            <a href="<?=base_url("dashboard")?>" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="<?=base_url()?>assets/images/logo.png" alt="" height="60">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?=base_url()?>assets/images/logo-dark.png" alt="" height="50">
                                </span>
                            </a>

                            <a href="<?=base_url("dashboard")?>" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="<?=base_url()?>assets/images/logo-lights.png" alt="" height="60">
                                </span>
                                <span class="logo-lg">
                                    <img src="<?=base_url()?>assets/images/logo-light.png" alt="" height="50">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <!-- App Search-->
                        <form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="bx bx-search-alt"></span>
                            </div>
                        </form>
                        <!--###################  MEGA MENU ########################-->
                        <!--<div class="dropdown dropdown-mega d-none d-lg-block ms-2">-->
                        <!--    <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="false" aria-expanded="false">-->
                        <!--        <span key="t-megamenu">Mega Menu</span>-->
                        <!--        <i class="mdi mdi-chevron-down"></i> -->
                        <!--    </button>-->
                        <!--    <div class="dropdown-menu dropdown-megamenu">-->
                        <!--        <div class="row">-->
                        <!--            <div class="col-sm-8">-->
    
                        <!--                <div class="row">-->
                        <!--                    <div class="col-md-4">-->
                        <!--                        <h5 class="font-size-14" key="t-ui-components">UI Components</h5>-->
                        <!--                        <ul class="list-unstyled megamenu-list">-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-lightbox">Lightbox</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-range-slider">Range Slider</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-sweet-alert">Sweet Alert</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-rating">Rating</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-forms">Forms</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-tables">Tables</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-charts">Charts</a>-->
                        <!--                            </li>-->
                        <!--                        </ul>-->
                        <!--                    </div>-->

                        <!--                    <div class="col-md-4">-->
                        <!--                        <h5 class="font-size-14" key="t-applications">Applications</h5>-->
                        <!--                        <ul class="list-unstyled megamenu-list">-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-ecommerce">Ecommerce</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-calendar">Calendar</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-email">Email</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-projects">Projects</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-tasks">Tasks</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-contacts">Contacts</a>-->
                        <!--                            </li>-->
                        <!--                        </ul>-->
                        <!--                    </div>-->

                        <!--                    <div class="col-md-4">-->
                        <!--                        <h5 class="font-size-14" key="t-extra-pages">Extra Pages</h5>-->
                        <!--                        <ul class="list-unstyled megamenu-list">-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-light-sidebar">Light Sidebar</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-compact-sidebar">Compact Sidebar</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-horizontal">Horizontal layout</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-maintenance">Maintenance</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-coming-soon">Coming Soon</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-timeline">Timeline</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-faqs">FAQs</a>-->
                        <!--                            </li>-->
                            
                        <!--                        </ul>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--            <div class="col-sm-4">-->
                        <!--                <div class="row">-->
                        <!--                    <div class="col-sm-6">-->
                        <!--                        <h5 class="font-size-14" key="t-ui-components">UI Components</h5>-->
                        <!--                        <ul class="list-unstyled megamenu-list">-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-lightbox">Lightbox</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-range-slider">Range Slider</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-sweet-alert">Sweet Alert</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-rating">Rating</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-forms">Forms</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-tables">Tables</a>-->
                        <!--                            </li>-->
                        <!--                            <li>-->
                        <!--                                <a href="javascript:void(0);" key="t-charts">Charts</a>-->
                        <!--                            </li>-->
                        <!--                        </ul>-->
                        <!--                    </div>-->

                        <!--                    <div class="col-sm-5">-->
                        <!--                        <div>-->
                        <!--                            <img src="<?=base_url()?>assets/images/megamenu-img.png" alt="" class="img-fluid mx-auto d-block">-->
                        <!--                        </div>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->

                        <!--    </div>-->
                        <!--</div>-->
                         <!--###################  MEGA MENU ########################-->
                        
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
        
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img id="header-lang-img" src="<?=base_url()?>assets/images/flags/us.jpg" alt="Header Language" height="16">
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="en">
                                    <img src="<?=base_url()?>assets/images/flags/us.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                                </a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp">
                                    <img src="<?=base_url()?>assets/images/flags/spain.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="gr">
                                    <img src="<?=base_url()?>assets/images/flags/germany.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="it">
                                    <img src="<?=base_url()?>assets/images/flags/italy.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru">
                                    <img src="<?=base_url()?>assets/images/flags/russia.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                                </a>
                            </div>
                        </div>

                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-customize"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                                <div class="px-lg-2">
                                    <div class="row g-0">
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="https://icon2.cleanpng.com/20180326/daw/kisspng-amazon-com-shopping-cart-online-shopping-logo-store-shelf-5ab95229ee6ea4.6575391715220946339766.jpg" alt="Purchase">
                                                <span>Create Purchase</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="https://w7.pngwing.com/pngs/882/987/png-transparent-sale-logo-sale-on-sale-sell.png" alt="Sale">
                                                <span>Create Sale</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="<?=base_url()?>assets/images/brands/dribbble.png" alt="dribbble">
                                                <span>Dribbble</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row g-0">
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="<?=base_url()?>assets/images/brands/dropbox.png" alt="dropbox">
                                                <span>Dropbox</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="<?=base_url()?>assets/images/brands/mail_chimp.png" alt="mail_chimp">
                                                <span>Mail Chimp</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="<?=base_url()?>assets/images/brands/slack.png" alt="slack">
                                                <span>Slack</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                                <i class="bx bx-fullscreen"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-bell bx-tada"></i>
                                <span class="badge bg-danger rounded-pill">3</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0" key="t-notifications"> Notifications </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#!" class="small" key="t-view-all"> View All</a>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="javascript: void(0);" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="bx bx-cart"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1" key="t-your-order">Your order is placed</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1" key="t-grammer">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">3 min ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript: void(0);" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <img src="<?=base_url()?>assets/images/users/avatar-3.jpg"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">James Lemire</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1" key="t-simplified">It will seem like simplified English.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-hours-ago">1 hours ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript: void(0);" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="bx bx-badge-check"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1" key="t-shipped">Your item is shipped</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1" key="t-grammer">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">3 min ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="javascript: void(0);" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <img src="<?=base_url()?>assets/images/users/avatar-4.jpg"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Salena Layfield</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1" key="t-occidental">As a skeptical Cambridge friend of mine occidental.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-hours-ago">1 hours ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2 border-top d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">View More..</span> 
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="<?=base_url()?>assets/images/logo-lights.png"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1" key="t-henry"><?=$sesData->NAME?></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                                <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle me-1"></i> <span key="t-my-wallet">My Wallet</span></a>
                                <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end">11</span><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Settings</span></a>
                                <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle me-1"></i> <span key="t-lock-screen">Lock screen</span></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="<?=base_url('logout')?>"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                            </div>
                        </div>

                        <!--<div class="dropdown d-inline-block">-->
                        <!--    <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">-->
                        <!--        <i class="bx bx-cog bx-spin"></i>-->
                        <!--    </button>-->
                        <!--</div>-->

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
                                <a href="<?=base_url("dashboard")?>" class="waves-effect">
                                    <i class="bx bx-home-circle"></i>
                                    <span key="t-dashboards">Dashboards</span>
                                </a>
                            </li>
                            
                            <?php if(dashRole(["role_check"=>"SALE"])){?>
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-line-chart"></i>
                                        <span key="t-dashboards">Sale</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <?php if(dashRole(["role_check"=>"SALE_ORDER_LIST"])){?> <li><a href="<?=base_url('SaleOrderList')?>" key="t-tui-calendar">SALE ORDER</a></li><?php } ?>
                                        <?php if(dashRole(["role_check"=>"SALE_INVOICE_LIST"])){?> <li><a href="<?=base_url('SaleInvoiceList')?>" key="t-full-calendar">SALE INVOICE</a></li><?php } ?>
                                        <?php if(dashRole(["role_check"=>"SALE_RETURN_LIST"])){?> <li><a href="<?=base_url('SaleReturnList')?>" key="t-full-calendar"> SALES RETURN / CR. Note</a></li><?php } ?>
                                        <?php if(dashRole(["role_check"=>"SALE_GL_TRANSACTION"])){?> <li><a href="<?=base_url('glTransSale')?>" key="t-full-calendar">SALE GL TRANSACTION</a></li><?php } ?>
                                        <?php if(dashRole(["role_check"=>"SALE_GL_ENTRY"])){?> <li><a href="<?=base_url('systemGlEntry')?>" key="t-full-calendar">POST SALE JOURNAL TO G/L</a></li><?php } ?>
                                        <?php if(dashRole(["role_check"=>"REPORT-SO_DAILY_SALE_REPORT"])){?> <li><a href="<?=base_url('dailySaleReport')?>" key="t-full-calendar">DAILY SALE REPORT</a></li><?php } ?>

                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if(dashRole(["role_check"=>"PURCHASE"])){?>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bxl-product-hunt"></i>
                                    <span key="t-dashboards">Purchase</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <?php if(dashRole(["role_check"=>"PURCHASE_ORDER_LIST"])){?> <li><a href="<?=base_url('PurchaseOrderList')?>" key="t-tui-calendar">PURCHASE ORDER</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"PURCHASE_INVOICE_LIST"])){?> <li><a href="<?=base_url('PurchaseInvoiceList')?>" key="t-full-calendar">PURCHASE INVOICE</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"PURCHASE_RETURN_LIST"])){?> <li><a href="<?=base_url('PurchaseReturn')?>" key="t-full-calendar">PURCHASE RETURNS / DR. Note</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"PURCHASE_PRICE_CHANGE_ORDER_LIST"])){?> <li><a href="<?=base_url('PriceChangerView')?>" key="t-full-calendar">PRICE CHANGE ORDER</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"PURCHASE_GL_TRANSACTION"])){?> <li><a href="<?=base_url('glTransPurchase')?>" key="t-full-calendar">PURCHASE GL TRANSACTION</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"PURCHASE_GL_ENTRY"])){?> <li><a href="<?=base_url('systemGlEntryPO')?>" key="t-full-calendar">POST PURCHASE JOURNAL TO G/L</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"PURCHASE_VENDOR_PRICE_UPLOAD"])){?> <li><a href="<?=base_url('vendorPriceUpload')?>" key="t-full-calendar">VENDOR PRICE UPLOAD</a></li><?php } ?>
                                </ul>
                            </li>
                            <?php } ?>
                            <?php if(dashRole(["role_check"=>"PARTIES"])){?>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bxs-user-detail"></i>
                                    <span key="t-dashboards">Parties</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <?php if(dashRole(["role_check"=>"PARTIES_CUSTOMER_LIST"])){?><li><a href="<?=base_url('CustomerList')?>" key="t-tui-calendar">CUSTOMER</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"PARTIES_VENOR_LIST"])){?><li><a href="<?=base_url('VendorList')?>" key="t-full-calendar">VENDOR</a></li><?php } ?>
                                </ul>
                            </li>
                            <?php } ?>
                            <!--<li class="menu-title" key="t-apps">Apps</li>-->
                            <?php if(dashRole(["role_check"=>"PRODUCT"])){?>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-cube"></i>
                                    <span key="t-dashboards">Products</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <?php if(dashRole(["role_check"=>"PRODUCT_PRODUCT_LIST"])){?><li><a href="<?=base_url('ProductList')?>" key="t-tui-calendar">Products</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"PRODUCT_BULK_IMAGE_UPLOAD"])){?><li><a href="<?=base_url('bulkImageUpload')?>" key="t-tui-calendar">BULK IMAGE UPLOAD</a></li><?php } ?>
                                </ul>
                            </li>
                            <?php } ?>
                            <?php if(dashRole(["role_check"=>"INVENTORY"])){?>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-bar-chart-alt-2"></i>
                                    <span key="t-dashboards">Inventory</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <!-- <li><a href="<?=base_url('StockRecevied')?>" key="t-tui-calendar">STOCK RECEVIED</a></li> -->
                                    <?php if(dashRole(["role_check"=>"INVENTORY_INVENTORY_LIST"])){?><li><a href="<?=base_url('InventoryList')?>" key="t-full-calendar">INVENTORY LIST</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"INVENTORY_PHYSICAL_INVENTROY_COUNT_CREATE"])){?><li><a href="<?=base_url('PhysicalInventory')?>" key="t-full-calendar">PHYSICAL INVENTORY</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"INVENTORY_STOCK_TRANSFER_LIST"])){?><li><a href="<?=base_url('StockTransferList')?>" key="t-tui-calendar">STOCK TRANSFER LIST</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"INVENTORY_GL_TRANSACTION"])){?><li><a href="<?=base_url('glTransStock')?>" key="t-tui-calendar">STOCK GL TRANSACTION</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"INVENTORY_INV_TRANS"])){?><li><a href="<?=base_url('itemTrans')?>" key="t-tui-calendar">ITEM TRANSACTION</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"INVENTORY_TRANSFER_ENTRY"])){?> <li><a href="<?=base_url('systemGlEntryMT')?>" key="t-full-calendar">POST TRANSFER JOURNAL TO G/L</a></li><?php } ?>
                                    <!-- <li><a href="<?=base_url('StockAdjustment')?>" key="t-full-calendar">STOCK ADJUSTMENT</a></li> -->
                                    <!--<li><a href="calendar.javascript: void(0);" key="t-tui-calendar">WASTE MANAGEMENT</a></li>-->
                                </ul>
                            </li>
                            <?php } ?>
                            <?php if(dashRole(["role_check"=>"ACCOUNT_PAYABLE"]) || dashRole(["role_check"=>"ACCOUNT_PAYMENT_OUT_LIST_AND_CREATE_AP"])){?>
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-book"></i>
                                        <span key="t-dashboards">Account Payable</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <?php if(dashRole(["role_check"=>"ACCOUNT_PAYMENT_OUT_LIST_AND_CREATE_AP"])){?> <li><a href="<?=base_url('PaymentOut')?>" key="t-full-calendar">PAYMENT OUT</a></li><?php } ?>
                                        <!-- <?php if(dashRole(["role_check"=>"ACCOUNT_PAYABLE"])){?><li><a href="ecommerce-products.javascript: void(0);" key="t-products">Account Payable</a></li><?php } ?> -->
                                    </ul>
                                </li>
                                <?php } ?>
                            <?php if(dashRole(["role_check"=>"ACCOUNT_PAYMENT_IN_LIST_AND_CREATE_AR"]) || dashRole(["role_check"=>"ACCOUNT_RECEIVEABLE"])){?>
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bx-book"></i>
                                        <span key="t-dashboards">Account Receivable</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <?php if(dashRole(["role_check"=>"ACCOUNT_PAYMENT_IN_LIST_AND_CREATE_AR"])){?> <li><a href="<?=base_url('Payment')?>" key="t-full-calendar">PAYMENT IN</a></li><?php } ?>
                                        <!-- <?php if(dashRole(["role_check"=>"ACCOUNT_RECEIVEABLE"])){?><li><a href="ecommerce-product-detail.javascript: void(0);" key="t-product-detail">Account Receivable</a></li><?php } ?> -->
                                        <?php if(dashRole(["role_check"=>"ACCOUNT_ACCOUNT_RECEIVABLE_GL_TRANSACTION"])){?> <li><a href="<?=base_url('glTransAccRec')?>" key="t-full-calendar">ACCOUNT RECEIVABLE GL TRANSACTION</a></li><?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if(dashRole(["role_check"=>"ACCOUNT"])){?>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-book"></i>
                                    <span key="t-chat">Account</span>
                                </a>
                                
                                 <ul class="sub-menu" aria-expanded="false">
                                    <?php if(dashRole(["role_check"=>"ACCOUNT_NEW_SETUP"])){?><li><a href="<?=base_url('newAccSetup')?>" key="t-products">New Account Setup</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"ACCOUNT_GL_PROFILE"])){?><li><a href="<?=base_url('glMudleProfle')?>" key="t-products">GL Module Profile</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"ACCOUNT_GL_TRANSACTION"])){?><li><a href="<?=base_url('glTrans')?>" key="t-products">GL Transaction</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"ACCOUNT_GL_ENTRY_LIST"])){?><li><a href="<?=base_url('glEntryList')?>" key="t-customers">GL Entry List</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"ACCOUNT_POSTED_GL_ENTRY_LIST"])){?><li><a href="<?=base_url('glEntryPostedList')?>" key="t-customers">Posted GL List</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"ACCOUNT_POSTED_GL_ENTRY"])){?><li><a href="<?=base_url('postGLEntry')?>" key="t-customers">POST GL ENTRY</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"ACCOUNT_LEDGER"])){?><li><a href="ecommerce-customers.javascript: void(0);" key="t-customers">General Ledger</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"ACCOUNT_BALANCE_SHEET"])){?><li><a href="ecommerce-orders.javascript: void(0);" key="t-orders">Account Balancesheet</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"ACCOUNT_TRAIL_BALANCE"])){?><li><a href="<?=base_url('trailBalanceReport')?>" key="t-orders">Account Trial Balance</a></li><?php } ?>
                                </ul>

                            </li>
                            <?php } ?>
                            <?php if(dashRole(["role_check"=>"MANAGER"])){?>
                            <li>
                                <a href="javascript: void(0);" class="  waves-effect">
                                    <i class="bx bx-file"></i>
                                    <span key="t-file-manager">Manager</span>
                                </a>
                            </li>
                            <?php } ?>
                            <!--================= User Role Management ================-->
                            <?php if(dashRole(["role_check"=>"USER-ROLE-MANAGEMENT"])){?>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-user-circle"></i>
                                    <span key="t-dashboards">User Role Management</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <?php if(dashRole(["role_check"=>"USER-ROLE-MANAGEMENT_CREATE_GROUP_MODULE"])){?><li><a href="<?=base_url('createGrpMod')?>" key="t-tui-calendar">Create role group</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"USER-ROLE-MANAGEMENT_USER_ASSIGN_ROLE"])){?><li><a href="<?=base_url('userRoleAsign')?>" key="t-tui-calendar">User Assign Role</a></li><?php } ?>
                                </ul>
                            </li>
                            <?php } ?>
                            <!--================= Users ================-->
                            <?php if(dashRole(["role_check"=>"USERS"])){?>
                             <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-user-circle"></i>
                                    <span key="t-dashboards">Users</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <?php if(dashRole(["role_check"=>"USERS_EMPLOYEE_LIST"])){?><li><a href="<?=base_url('EmployeesList')?>" key="t-tui-calendar">Employees</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"USERS_SALESMAN_LIST"])){?><li><a href="<?=base_url('SalesManList')?>" key="t-tui-calendar">Sales Man</a></li><?php } ?>
                                </ul>
                            </li>
                            <?php } ?>
                            <?php if(dashRole(["role_check"=>"REPORT"])){?>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bxs-report"></i>
                                    <span key="t-ecommerce">Reports</span>
                                </a>
                                
                                <ul class="sub-menu" aria-expanded="false">

                                    <?php if(dashRole(["role_check"=>"REPORT-ICM"])){?>
                                        <li>
                                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                                <i class="bx bxs-report"></i>
                                                <span key="t-ecommerce">ICM</span>
                                            </a>
                                            <ul class="sub-menu" aria-expanded="false">
                                                <?php if(dashRole(["role_check"=>"REPORT-ICM_STOCK_STATUS_ORDER_BY_CLASS"])){?><li><a href="<?=base_url('stockStatusOrderByClass')?>" key="t-products">STOCK STATUS ORDER BY CLASS</a></li><?php } ?>
                                                <?php if(dashRole(["role_check"=>"REPORT-ICM_STOCK_STATUS_ORDER_BY_CLASS_AC"])){?><li><a href="<?=base_url('stockStatusOrderByClassAc')?>" key="t-products">STOCK STATUS ORDER BY CLASS (AC)</a></li><?php } ?>
                                                <?php if(dashRole(["role_check"=>"REPORT-ICM_STOCK_STATUS_ORDER_BY_CLASS_CONS"])){?><li><a href="<?=base_url('stockStatusOrderByClassCon')?>" key="t-products">STOCK STATUS ORDER BY CLASS-CONS</a></li><?php } ?>
                                                <?php if(dashRole(["role_check"=>"REPORT-ICM_STOCK_BY_VENDR_PRICE"])){?><li><a href="<?=base_url('stkVenPrice')?>" key="t-products">STOCK BY VENDOR PRICE REPORT</a></li><?php } ?>
                                                <?php if(dashRole(["role_check"=>"REPORT-ICM_ITEM_WITH_PICTURE"])){?><li><a href="<?=base_url('itemWithPicReport')?>" key="t-products">ITEM WITH PICTURE REPORT</a></li><?php } ?>
                                                <?php if(dashRole(["role_check"=>"REPORT-ICM_MANUAL_INVENTORY_TRANSACTION"])){?><li><a href="<?=base_url('manualInvTransReport')?>" key="t-products">MANUAL INVENTORY TRANSACTION</a></li><?php } ?>
                                                <?php if(dashRole(["role_check"=>"REPORT-ICM_MANUAL_INVENTORY_TRANSACTION_BY_VENDOR"])){?><li><a href="<?=base_url('manualInvTransVendorReport')?>" key="t-products">MANUAL INVENTORY TRANSACTION BY VENDOR</a></li><?php } ?>
                                                <?php if(dashRole(["role_check"=>"REPORT-ICM_ITEM_STOCK_WITH_PICTURE"])){?><li><a href="<?=base_url('itemStockWithPicReport')?>" key="t-products">ITEM STOCK WITH PICTURE</a></li><?php } ?>
                                                <?php if(dashRole(["role_check"=>"REPORT-ICM_VENDOR_STOCK"])){?><li><a href="<?=base_url('vendorStockReport')?>" key="t-products">VENDOR STOCK REPORT</a></li><?php } ?>
                                                <?php if(dashRole(["role_check"=>"REPORT-ICM_STOCK_STATUS_AS_OF_DATE"])){?><li><a href="<?=base_url('stkStaDate')?>" key="t-products">STOCK STATUS AS OF DATE</a></li><?php } ?>
                                                <?php if(dashRole(["role_check"=>"REPORT-ICM_INVENTORY_TRANSFER_ORDER_WITH_PICTURE"])){?><li><a href="<?=base_url('invTransfOrdWithPic')?>" key="t-products">INVENTORY TRANSFER ORDER WITH PICTURE</a></li><?php } ?>
                                                <?php if(dashRole(["role_check"=>"REPORT-ICM_YEAR_SALES_COMP_MONTH"])){?><li><a href="<?=base_url('yearSaleMonReport')?>" key="t-products">YEAR SALES COMP MONTH REPORT</a></li><?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    <?php if(dashRole(["role_check"=>"REPORT-SO"])){?>
                                        <li>
                                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                                <i class="bx bxs-report"></i>
                                                <span key="t-ecommerce">SALE ORDER</span>
                                            </a>
                                            <ul class="sub-menu" aria-expanded="false">
                                                <?php if(dashRole(["role_check"=>"REPORT-REPORT-SO_CONSIGNMENT_SALES_REPORT"])){?><li><a href="<?=base_url('consignSaleReport')?>" key="t-products">CONSIGNMENT SALES REPORT</a></li><?php } ?>
                                                <?php if(dashRole(["role_check"=>"REPORT-SO_MONTHLY_SALES_BY_CATEGORY"])){?><li><a href="<?=base_url('monSaleyVenByCatReport')?>" key="t-products">MONTHLY SALES BY VENDOR BY CATEGORY REPORT</a></li><?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    <?php if(dashRole(["role_check"=>"REPORT-PO"])){?>
                                        <li>
                                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                                <i class="bx bxs-report"></i>
                                                <span key="t-ecommerce">PURCHASE ORDER</span>
                                            </a>
                                            <ul class="sub-menu" aria-expanded="false">
                                                <?php if(dashRole(["role_check"=>"REPORT-PO_VENDOR_PURCHASE_BY_DATE"])){?><li><a href="<?=base_url('venPurByDate')?>" key="t-products">VENDOR PURCHASE BY DATE</a></li><?php } ?>
                                                <?php if(dashRole(["role_check"=>"REPORT-PO_CUSTOM_AND_MISC_CHARGES"])){?><li><a href="<?=base_url('custMiscCharg')?>" key="t-products">CUSTOM & MISC. CHARGES</a></li><?php } ?>
                                                <?php if(dashRole(["role_check"=>"REPORT-PO_PRINT_PURCHASE_ORDER_RETAIL_PRICE"])){?><li><a href="<?=base_url('purOrderRP')?>" key="t-products">PRINT PURCHASE ORDER RETAIL PRICE</a></li><?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    <?php if(dashRole(["role_check"=>"REPORT-AP"])){?>
                                        <li>
                                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                                <i class="bx bxs-report"></i>
                                                <span key="t-ecommerce">ACCOUNT PAYABLE</span>
                                            </a>
                                            <ul class="sub-menu" aria-expanded="false">
                                                <?php if(dashRole(["role_check"=>"REPORT-AP_PAYMENT_ACCOUNT_LIST"])){?><li><a href="<?=base_url('payAccList')?>" key="t-products">PAYMENT ACCOUNT LIST</a></li><?php } ?>
                                                <?php if(dashRole(["role_check"=>"REPORT-AP_VENDOR_STATEMENT"])){?><li><a href="<?=base_url('vendorState')?>" key="t-products">VENDOR STATEMENT</a></li><?php } ?>
                                                <?php if(dashRole(["role_check"=>"REPORT-AP_VENDOR_BALANCE_AND_AMOUNT_DUE"])){?><li><a href="<?=base_url('vendBalAndAmtDue')?>" key="t-products">VENDOR BALANCE AND AMOUNT DUE</a></li><?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    <?php if(dashRole(["role_check"=>"REPORT-AR"])){?>
                                        <li>
                                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                                <i class="bx bxs-report"></i>
                                                <span key="t-ecommerce">ACCOUNT RECEIVABLE</span>
                                            </a>
                                            <ul class="sub-menu" aria-expanded="false">
                                                <?php if(dashRole(["role_check"=>"REPORT-AR_CUSTOMER_STATEMENT"])){?><li><a href="<?=base_url('custState')?>" key="t-products">CUSTOMER STATEMENT</a></li><?php } ?>
                                                <?php if(dashRole(["role_check"=>"REPORT-AR_CUSTOMER_TRAIL_BALANCE"])){?><li><a href="<?=base_url('custTrailBal')?>" key="t-products">CUSTOMER TRIAL BALANCE</a></li><?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    <!-- <?php if(dashRole(["role_check"=>"REPORT_SALES_REPORT"])){?><li><a href="<?=base_url('SaleReport')?>" key="t-product-detail">SALE REPORT</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"REPORT_PURCHASES_REPORT"])){?><li><a href="<?=base_url('PurchaseReport')?>" key="t-orders">PURCHASE REPORT</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"REPORT_PRODUCTS_REPORT"])){?><li><a href="<?=base_url('ProductReport')?>" key="t-customers">PRODUCTS REPORT</a></li><?php } ?> -->
                                </ul>
                            </li>
                            <?php } ?>
                            <!--=============================== SETTINGS =============================-->
                            
                            
                            <?php if(dashRole(["role_check"=>"SETTING"])){?>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-cog bx-spin"></i>
                                    <span key="t-crypto">Settings</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    
                                    <?php if(dashRole(["role_check"=>"SETTING_SYSTEM"])){?><li><a href="<?=base_url('systemSetting')?>" key="t-wallet">System setting</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_BUSINESS_UNIT_LIST"])){?><li><a href="<?=base_url('BusinessUnitList')?>" key="t-wallet">Business Unit</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_WAREHOUSE_LIST"])){?><li><a href="<?=base_url('WarehouseList')?>" key="t-wallet">Warehouse</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_COUNTRY_LIST_AND_CREATE"])){?><li><a href="<?=base_url('CountryList')?>" key="t-ico">Country</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_STATE_LIST_AND_CREATE"])){?><li><a href="<?=base_url('stateList')?>" key="t-ico">State</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_CITY_LIST_AND_CREATE"])){?><li><a href="<?=base_url('CityList')?>" key="t-exchange">City</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_PASSWORD_LIST_AND_CREATE"])){?><li><a href="<?=base_url('PasswordList')?>" key="t-exchange">Password</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_CURRENCY_LIST_AND_CREATE"])){?><li><a href="<?=base_url('currencyList')?>" key="t-lending">Currency</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_CURRENCY_EXCHANGE_LIST_AND_CREATE"])){?><li><a href="<?=base_url('CurrencyExList')?>" key="t-exchange">Currency Exchange</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_UNIT_OF_MANAGEMENT_LIST_AND_CREATE"])){?><li><a href="<?=base_url('UOMList')?>" key="t-orders">UOM</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_ITEM_CATEGORY_LIST_AND_CREATE"])){?><li><a href="<?=base_url('ItemCategoryList')?>" key="t-kyc">Item Category </a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_ITEM_CLASS_LIST_AND_CREATE"])){?><li><a href="<?=base_url('ItemClassList')?>" key="t-ico">Item Class</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_TRAIT_CATEGORY_LIST_AND_CREATE"])){?><li><a href="<?=base_url('TraiteCategoryList')?>" key="t-orders">Traite Category</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_TRAIT_LIST_AND_CREATE"])){?><li><a href="<?=base_url('TraitesList')?>" key="t-kyc">Traites </a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_PAYMENT_METHOD_LIST_AND_CREATE"])){?><li><a href="<?=base_url('PaymentMethodList')?>" key="t-ico">Payment Method </a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_BANK_UPDATE"])){?><li><a href="<?=base_url('BankList')?>" key="t-orders">Bank</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_FREIGHT_LIST_AND_CREATE"])){?><li><a href="<?=base_url('FreightList')?>" key="t-ico">Freight </a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_FOB_LIST_AND_CREATE"])){?><li><a href="<?=base_url('FOBList')?>" key="t-ico">FOB </a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_SHIP_VIA_LIST_AND_CREATE"])){?><li><a href="<?=base_url('ShipList')?>" key="t-ico">Ship Via </a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_TERMS_LIST_AND_CREATE"])){?><li><a href="<?=base_url('TermsList')?>" key="t-ico">Terms</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_PO_CHARGE_LIST_AND_CREATE"])){?><li><a href="<?=base_url('POChargesList')?>" key="t-kyc">PO Charges</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_PO_PREFIX_LIST_AND_CREATE"])){?><li><a href="<?=base_url('POPrefixesList')?>" key="t-ico">PO Prefixes</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_FINANCIAL_YEAR_LIST_AND_CREATE"])){?><li><a href="<?=base_url('FiscalYearsList')?>" key="t-ico">Fiscal Years</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_FINANCIAL_PERIODS_LIST_AND_CREATE"])){?><li><a href="<?=base_url('FiscalPeriodsList')?>" key="t-ico">Fiscal Periods</a></li><?php } ?>
                                    <?php if(dashRole(["role_check"=>"SETTING_GL_PREFIX_LIST_AND_CREATE"])){?><li><a href="<?=base_url('GLPrefixesList')?>" key="t-ico">GL Prefixes</a></li><?php } ?>
                                    
                                    
                                </ul>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
            <noscript>
                <div class="main-content">
                    <div class="page-content">
                        <div class="container-fluid">
                            <!-- <div style="border: 1px solid purple; padding: 10px position: fixed; top: 0px; left: 0px; z-index: 30000000; 
                                        height: 100%; width: 100%; background-color: #FFFFFF">
                                <p style="margin-left: 10px"><span style="color:red">JavaScript is not enabled. To enable Javascript, check your browser's options.</span></p>
                            </div> -->
                            <div style="border: 1px solid purple; padding: 10px;position: fixed; top: 0px; left: 0px; z-index: 30000000; 
                                        height: 100%; width: 100%; background-color: #FFFFFF">
                                <h1 style="margin-left: 10px;color:red">JavaScript is not enabled. To enable Javascript, check your browser's options.</h1>
                            </div>
                        </div>
                    </div>
                </div> 
            </noscript>
            
            