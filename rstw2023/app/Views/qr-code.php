<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<?php $uri = service('uri');
    $userid = $uri->getSegment(2);
?>

    <div class="container d-flex h-100">
        <div class="row align-items-center w-100" style="margin-left: 0px;">
            <div class="col-md-12 col-lg-12 m-h-auto">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between m-b-30">
                            <div class="row">
                                <div class="col-12">
                                    <img class="img-fluid" src="<?=base_url('assets/images/logo/handa-logo-black.png')?>">
                                </div>
                                <div class="mt-3 col-12">
                                <h1 class="text-center my-3">Thank You for Registering!</h1>
                                <p>
                                We are excited to see you celebrate Science and Technology Week with us.</p>
                                <p>For the complete Schedule of Activities, please visit: <a href="https://simplebooklet.com/rstw2023activities">simplebooklet.com/rstw2023activities</a></p>
                                <p>For concerns or inquiries, feel free to message us at Facebook <a href="https://www.facebook.com/DOST10Ph">DOST Regional Office 10</a>.</p>
                                <p>Have a great day, ka-Agham!</p>

                                <hr>
                                    <p class="text-center">Please download the QR code and present it to the registration booth.</p>
                                </div>
                                <div class="col-md-12">
                                    <img class="img-fluid mx-auto d-block" src="<?=base_url('uploads/qr/'.$userid)?>.png">
                                    <p class="text-center font-weight-semibold"><?=$userid?></p>
                                </div>
                                <div class="col-md-12 mt-3 text-center">
                                    <a class="btn btn-success custom-class" download="<?=$userid?>.png" href="<?=base_url('uploads/qr/'.$userid)?>.png" target="_blank">
                                        Download
                                    </a>
                                </div>
                                <?php if (session()->get('logged_in')) {
                                    ?>
                                    <div class="col-md-12 mt-3 text-center">
                                        <a class="text-success" href="<?php if(isset($_SESSION['previous_url'])) {
                                            echo $_SESSION['previous_url'];
                                        }else{ echo "#"; }?>">
                                            <u>Register Another</u>
                                        </a>
                                    </div>
                                    <?php
                                }?>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>