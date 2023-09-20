<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=$pagetitle;?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=base_url("assets/images/logo/favicon.png")?>">

    <!-- page css -->

    <!-- Core css -->
    <link href="<?=base_url("assets/css/app.min.css")?>" rel="stylesheet">

    <style>
        @media all and (max-width:480px) {
   .custom-class { width: 100%; display:block; }
}   
    </style>

    <script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
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

    
    <!-- Core Vendors JS -->
    <script src="<?=base_url("assets/js/vendors.min.js")?>"></script>

    <!-- page js -->

    <!-- Core JS -->
    <script src="<?=base_url("assets/js/app.min.js")?>"></script>

</body>

</html>

