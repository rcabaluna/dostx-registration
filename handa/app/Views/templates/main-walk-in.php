<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=$pagetitle;?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=base_url("assets/images/logo/favicon.png")?>">
    <!-- Core css -->
    <link href="<?=base_url("assets/css/app.min.css")?>" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url('assets/vendors/datatables/buttons.dataTables.min.css')?>" />

    <style>
        @media all and (max-width:480px) {
        .custom-class { width: 100%; display:block; }
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
        <script>
            function show_notification_confirmed(xtype) {
                var toastHTML = `<div class="toast fade hide" data-delay="3000">
                    <div class="toast-header">
                        <i class="anticon anticon-info-check text-success m-r-5"></i>
                        <strong class="mr-auto text-success">Success</strong>
                        <button type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        The `+xtype+` is confirmed. Thank you!
                    </div>
                </div>`

                $('#notification-toast').append(toastHTML)
                $('#notification-toast .toast').toast('show');
                setTimeout(function(){ 
                    $('#notification-toast .toast:first-child').remove();
                }, 10000);
            }

            function show_notification_exists(xtype) {
                var toastHTML = `<div class="toast fade hide" data-delay="3000">
                    <div class="toast-header">
                        <i class="anticon anticon-info-circle text-danger m-r-5"></i>
                        <strong class="mr-auto text-danger">Exists</strong>
                        <button type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        Your attendance is already confirmed.
                    </div>
                </div>`

                $('#notification-toast').append(toastHTML)
                $('#notification-toast .toast').toast('show');
                setTimeout(function(){ 
                    $('#notification-toast .toast:first-child').remove();
                }, 10000);
            }
        </script>
</head>

<?php $uri = service('uri'); ?>
<body>
    <div class="app">
        <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" style="background-image: url('<?=base_url('assets/images/others/bg-red.png')?>'); background-attachment: fixed;">
            <div class="d-flex flex-column justify-content-between w-100">
                <div class="container-fluid d-flex h-100">
                    <?= $this->renderSection('content') ?>
                </div>
                <!-- <div class="d-none d-md-flex p-h-40 justify-content-between">
                    <span class="text-white">© <?=date('Y')?> <a href="https://region10.dost.gov.ph">DOST 10</a></span>
                </div> -->
            </div>
        </div>
    </div>



    <!-- Core JS -->
    <script src="<?=base_url("assets/js/app.min.js")?>"></script>

</body>

</html>

