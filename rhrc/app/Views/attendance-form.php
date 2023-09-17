<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<div class="row align-items-center w-100" style="margin-left: 0px;">
    <div class="col-md-12 col-lg-12 m-h-auto">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between m-b-10">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <img class="img-fluid" src="<?=base_url('assets/images/logo/handa-logo-black.png')?>">
                        </div>
                        <div class="mt-3 mb-2 col-12">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, in nisi voluptatem quae, sed tempore autem ab numquam vitae eveniet officiis at itaque eligendi saepe molestiae. Aperiam ullam fuga expedita.</p>
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

                            if (!$_GET) {
                                $hidesearch = '';
                            }

                        ?>
                        <div class="col-md-12">
                            <form method="GET" action="<?=base_url('/attendance')?>" <?=$hidesearch;?>>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-semibold">Enter Name or Registration Number <small class="text-danger">*</small></label>
                                        <input type="text" class="form-control input-lg" name="regnumber" placeholder="Name or Registration Number" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <button class="btn btn-danger custom-class float-right">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <?php
                                if (isset($_SESSION['valid'])) {
                                    ?>
                                    <form method="POST" action="<?=base_url('/confirm-attendance')?>">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                            <label for="">Registration Number<small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" value="<?=$regnumber?>" disabled>
                                            <input type="hidden" class="form-control" name="regnumber" value="<?=$regnumber?>">
                                            </div>
                                            <div class="form-group col-md-12">
                                            <label class="font-weight-semibold">Full Name (First Name, M.I, Last Name, Suffix) <small class="text-danger">*</small></label>

                                                <input type="text" class="form-control" name="fullname" value="<?=$fullname?>" disabled placeholder="Last Name, First Name, Suffix, M.I" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Contact Number <small class="text-danger">*</small></label>
                                                <input type="number" class="form-control" name="contactno" value="<?=$contactno?>" disabled placeholder="Contact Number" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Email Address <small class="text-danger">*</small></label>
                                                <input type="email" class="form-control" name="email" value="<?=$email?>" disabled placeholder="Email Address" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Position <small class="text-danger">*</small></label>
                                                <input type="text" name="position" value="<?=$position?>" disabled class="form-control" placeholder="Designation" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Agency/Unit/LGU <small class="text-danger">*</small></label>
                                                <input type="text" name="agency_name" value="<?=$agency_name?>" disabled class="form-control" placeholder="Name of Institution/Agency" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Sex <small class="text-danger">*</small></label>
                                                <input type="text" class="form-control" value="<?=$sex;?>" disabled>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Privileges</label>
                                                <input type="text" class="form-control" value="<?=$privileges;?>" disabled>
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
<?= $this->endSection() ?>