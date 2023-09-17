<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<?php $uri = service('uri');
    $userid = $uri->getSegment(3);
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
                                <p class="text-dark">
                                Thank you for registering for the 6th Regional Health Research Conference (Northern Mindanao) your participation is invaluable in driving the success of this event. We're delighted to have you join us celebrating the health research in the region. Just keep updated on the event details and receive important announcements.</p>
                                    <p class="text-center text-dark">Please download the QR code and present it to the registration booth during the event.</p>
                                </div>
                                <div class="col-md-12">
                                    <img class="img-fluid mx-auto d-block" src="<?=base_url('uploads/qr/'.$userid)?>.png">
                                    <p class="text-center font-weight-semibold text-dark"><?=$userid?></p>
                                </div>
                                <div class="col-md-12 mt-3 text-center">
                                    <a class="btn btn-primary custom-class" download="<?=$userid?>.png" href="<?=base_url('uploads/qr/'.$userid)?>.png" target="_blank">
                                        Download
                                    </a>
                                </div>
                                <?php if (session()->get('logged_in')) {
                                    ?>
                                    <div class="col-md-12 mt-3 text-center">
                                        <a class="text-primary" href="">
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