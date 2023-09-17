<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bukidnon DRRM Contingency Planning - Register</title>

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
</head>

<?php $uri = service('uri'); ?>
<body>
    <div class="app">
        <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" style="background-image: url('<?=base_url('assets/images/others/bg-red.png')?>'); background-attachment: fixed;">
            <div class="d-flex flex-column justify-content-between w-100">
                <div class="container d-flex h-100">
                    <div class="row align-items-center w-100" style="margin-left: 0px;">
                        <div class="col-md-12 col-lg-12 m-h-auto">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between m-b-10">
    
                                        <div class="row">
                                            <div class="col-12">
                                                <img class="img-fluid" src="<?=base_url('assets/images/logo/handa-logo-black.png')?>">
                                            </div>
                                            <div class=" mt-3 col-12">
                                                <p>Enter your registration number below:</p>
                                            </div>
                                            <?php
                                                $hidesearch = '';
                                                if (isset($_SESSION['invalid'])) {
                                                    ?>
                                                    <div class=" mt-3 col-md-12">
                                                        <div class="alert alert-danger">
                                                            Invalid registration number! Please try again.
                                                        </div>
                                                    </div>
                                                    <?php
                                                }else{
                                                    $hidesearch = 'hidden';
                                                }
                                            ?>
                                            <div class="col-md-12">
                                                <form method="GET" action="<?=base_url('/event/'.$uri->getSegment(2).'/search')?>" <?=$hidesearch;?>>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label class="font-weight-semibold">Enter Registration Number <small class="text-danger">*</small></label>
                                                            <input type="text" class="form-control input-lg" name="regnumber" placeholder="Registration Number" required>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <button class="btn btn-danger custom-class float-right">Search</button>
                                                        </div>
                                                    </div>
                                                </form>

                                                <?php
                                        if (isset($_SESSION['valid'])) {
                                    ?>
                                    <form method="GET" action="<?=base_url('/event/'.$uri->getSegment(2).'/confirm')?>">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                            <input type="hidden" class="form-control" name="regnumber" value="<?=$regnumber?>">
                                                <label class="font-weight-semibold">Full Name (First Name, M.I, Last Name, Suffix) <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control" value="<?=$fullname?>" placeholder="First Name, M.I, Last Name, Suffix" disabled>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Email <small class="text-danger">*</small></label>
                                                <input type="email" class="form-control" value="<?=$email;?>" placeholder="Email" disabled>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Mobile No. <small class="text-danger">*</small></label>
                                                <input type="number" class="form-control" value="<?=$mobileno;?>" placeholder="Mobile No." disabled>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Sex <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control" value="<?=$sex;?>" disabled>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Age <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control" value="<?=$age;?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">City/Municipality <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control" value="<?=$address_city_mun?>" disabled>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Province <small class="text-danger">*</small></label>
                                                <input type="texxt" class="form-control" value="<?=$address_province?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Affiliation <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control" value="<?=$affiliation?>" disabled>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="exampleFormControlSelect1" class="ms-0">Institution/Agency Category <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control" value="<?=$institution_category?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Name of Institution/Agency</label>
                                                <input type="text" class="form-control" placeholder="Name of Institution/Agency" value="<?=$institution_name;?>" disabled>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Designation</label>
                                                <input type="texxt" class="form-control" placeholder="Designation" value="<?=$designation;?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <button class="btn btn-danger custom-class float-right">Confirm</button>
                                            </div>
                                        </div>
                                    </form>        
                                            
                                    <?php
                                        }
                                    
                                    ?>
                                            </div>
                                        </div>
                                    </div>

                                
                                </div>
                            </div>
                        </div>
                    </div>
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