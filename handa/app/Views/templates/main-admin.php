<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title><?=$pagetitle?></title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="<?=base_url('assets/images/logo/favicon.png')?>" />

        <!-- page css -->
        <link href="<?=base_url('assets/vendors/datatables/dataTables.bootstrap.min.css')?>" rel="stylesheet" />
        <link rel="stylesheet" href="<?=base_url('assets/vendors/datatables/buttons.dataTables.min.css')?>" />
        <!-- Core css -->
        <link href="<?=base_url('assets/css/app.min.css')?>" rel="stylesheet" />

        <style>
            .activex {
                color: #fff !important;
      
            }

            @media all and (max-width: 480px) {
                .custom-class {
                    width: 100%;
                    display: block;
                }
            }
        </style>

        <!-- SCRIPTS -->
        <!-- Core Vendors JS -->
        <script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
        <script src="<?=base_url('assets/js/vendors.min.js')?>"></script>

        <!-- page js -->
        <script src="<?=base_url('assets/vendors/datatables/jquery.dataTables.min.js')?>"></script>
        <script src="<?=base_url('assets/vendors/datatables/dataTables.bootstrap.min.js')?>"></script>
        <script src="<?=base_url('assets/vendors/datatables/dataTables.buttons.min.js')?>"></script>
        <script src="<?=base_url('assets/vendors/datatables/jszip.min.js')?>"></script>
        <script src="<?=base_url('assets/vendors/datatables/buttons.html5.min.js')?>"></script>
        <!-- Core JS -->
        <script src="<?=base_url('assets/js/app.min.js')?>"></script>
        <script src="<?=base_url('assets/js/instascan.min.js')?>"></script>
        <script>
            function show_notification_delete(xtype) {
                var toastHTML = `<div class="toast fade hide" data-delay="3000">
                    <div class="toast-header">
                        <i class="anticon anticon-info-circle text-danger m-r-5"></i>
                        <strong class="mr-auto text-danger">Deleted</strong>
                        <button type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        The `+xtype+` data has been deleted.
                    </div>
                </div>`

                $('#notification-toast').append(toastHTML)
                $('#notification-toast .toast').toast('show');
                setTimeout(function(){ 
                    $('#notification-toast .toast:first-child').remove();
                }, 5000);
            }
        </script>
    </head>

    <body>
        <div class="app is-danger is-folded">
            <div class="layout is-side-nav-dark">
                <!-- Header START -->
                <div class="header">
                    <div class="logo logo-dark">
                        <a href="<?=base_url('/admin/dashboard')?>">
                            <img src="assets/images/logo/logo.png" alt="Logo" />
                            <img class="logo-fold" src="assets/images/logo/logo-fold.png" alt="Logo" />
                        </a>
                    </div>
                    <div class="logo logo-white">
                        <a href="<?=base_url('/admin/dashboard')?>">
                            <img src="<?=base_url('assets/images/logo/logo-white.png')?>" alt="Logo" />
                            <img class="logo-fold" src="<?=base_url('assets/images/logo/logo-fold-white.png')?>" alt="Logo" />
                        </a>
                    </div>
                    <div class="nav-wrap">
                        <ul class="nav-left">
                            <li class="desktop-toggle">
                                <a href="javascript:void(0);">
                                    <i class="anticon"></i>
                                </a>
                            </li>
                            <li class="mobile-toggle">
                                <a href="javascript:void(0);">
                                    <i class="anticon"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Header END -->

                <!-- Side Nav START -->
                <div class="side-nav">
                    <div class="side-nav-inner">
                        <ul class="side-nav-menu scrollable">
                            <?php if ($_SESSION['usertype'] != 'user') {
                                ?>
                                <li class="nav-item dropdown" id="ul-four">
                                    <a class="dropdown-toggle" href="javascript:void(0);">
                                        <span class="icon-holder">
                                            <i class="anticon anticon-dashboard"></i>
                                        </span>
                                        <span class="title">Dashboard</span>
                                        <span class="arrow">
                                            <i class="arrow-icon"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li id="li-reg-att-stats">
                                            <a href="<?=base_url('/admin/dashboard/reg-att')?>">Registration and Attendance</a>
                                        </li>
                                        <li id="li-evaluation-stats">
                                            <a href="<?=base_url('/admin/dashboard/evaluation')?>">Evaluation</a>
                                        </li>
                                    </ul>
                                </li>
                                
                                
                            <li class="nav-item dropdown" id="ul-three">
                                <a class="dropdown-toggle" href="javascript:void(0);">
                                    <span class="icon-holder">
                                        <i class="anticon anticon-usergroup-add"></i>
                                    </span>
                                    <span class="title">Registration</span>
                                    <span class="arrow">
                                        <i class="arrow-icon"></i>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li id="li-reg-links">
                                        <a href="<?=base_url('/registration/links')?>">QR Codes/Links</a>
                                    </li>
                                    <li id="li-walkin">
                                        <a href="<?=base_url('/registration/w-list')?>">Walk-in QR Links</a>
                                    </li>
                                    <li id="li-participants">
                                        <a href="<?=base_url('/participants?event=all')?>">Participants List</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown" id="ul-one">
                                <a class="dropdown-toggle" href="javascript:void(0);">
                                    <span class="icon-holder">
                                        <i class="anticon anticon-idcard"></i>
                                    </span>
                                    <span class="title">Attendance</span>
                                    <span class="arrow">
                                        <i class="arrow-icon"></i>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li id="li-attendance-search-user">
                                        <a href="<?=base_url('/attendance/search-user')?>">Confirm Attendance <small>(Search)</small></a>
                                    </li>
                                    <li id="li-m-attendance-qr-scanner">
                                        <a href="<?=base_url('attendance/m-scan-qr')?>">Confirm Attendance <small>(QR)</small></a>
                                    </li>
                                    <li id="li-attendance">
                                        <a href="<?=base_url('/attendance?event=all')?>">Attendance List</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown" id="ul-six">
                                <a class="dropdown-toggle" href="javascript:void(0);">
                                    <span class="icon-holder">
                                        <i class="anticon anticon-form"></i>
                                    </span>
                                    <span class="title">Evaluation</span>
                                    <span class="arrow">
                                        <i class="arrow-icon"></i>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li id="li-evaluation-links">
                                        <a href="<?=base_url('/evaluation/links')?>">Links</a>
                                    </li>
                                    <li id="li-evaluation-participants">
                                        <a href="<?=base_url('/evaluation/participants?event=all')?>">Participants List</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown" id="ul-two">
                                <a class="dropdown-toggle" href="javascript:void(0);">
                                    <span class="icon-holder">
                                        <i class="anticon anticon-qrcode"></i>
                                    </span>
                                    <span class="title">Scanners</span>
                                    <span class="arrow">
                                        <i class="arrow-icon"></i>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    
                                    <li id="li-attendance-scanner">
                                        <a href="javascript:void(0)">Food</a>
                                    </li>
                                </ul>
                            </li>
                            <?php } ?>

                            <?php if ($_SESSION['usertype'] == 'user') { ?>
                            
                            <li class="nav-item dropdown" id="ul-one">
                                <a class="dropdown-toggle" href="javascript:void(0);">
                                    <span class="icon-holder">
                                        <i class="anticon anticon-ordered-list"></i>
                                    </span>
                                    <span class="title">Lists</span>
                                    <span class="arrow">
                                        <i class="arrow-icon"></i>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li id="li-participants">
                                        <a href="<?=base_url('/participants?event='.$_SESSION['eventaccess'])?>">Participants List</a>
                                    </li>
                                </ul>
                            </li>
                            <?php
                            }?>

                            <li class="nav-item dropdown" id="ul-five">
                                <a class="dropdown-toggle" href="<?=base_url('/logout')?>">
                                    <span class="icon-holder">
                                        <i class="anticon anticon-logout"></i>
                                    </span>
                                    <span class="title">Logout</span>
                                </a>
                            </li>
                           
                        </ul>
                    </div>
                </div>
                <!-- Side Nav END -->

                <!-- Page Container START -->
                <div class="page-container">
                    
                    <!-- Content Wrapper START -->
                    <?= $this->renderSection('content') ?>
                    <!-- Content Wrapper END -->

                    <!-- Footer START -->
                    <footer class="footer">
                        <div class="footer-content">
                            <p class="m-b-0">
                                Copyright ©
                                <?=date('Y')?>
                                Developed by DOST 10 MIS - Unit <small>(ROCJ)</small>. All rights reserved.
                            </p>
                        </div>
                    </footer>
                    <!-- Footer END -->
                </div>
                <!-- Page Container END -->
            </div>
        </div>
        
    </body>
</html>
