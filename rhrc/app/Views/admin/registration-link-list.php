<?= $this->extend('templates/main-admin') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Registration QR Codes/Links (Pre-register)</h2>
    </div>
    <div class="row">
        <?php
            foreach ($events as $eventsRow) {
                ?>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img class="img-fluid" src="<?=base_url('assets/images/others/rhrc-registration-qr.png')?>" alt="">
                                </div>
                                <div class="col-md-8">
                                    <h5 class="m-b-10 text-dark"><b> <?=$eventsRow['name']?></b></h5>
                                    <div class="d-flex align-items-center m-t-5 m-b-15">
                                        <div class="m-l-10">
                                            <span class="text-gray font-weight-semibold"><?=$eventsRow['venue']?></span>
                                            <span class="m-h-5 text-gray">|</span>
                                            <span class="text-gray"><?=$eventsRow['datetime']?></span>
                                        </div>
                                    </div>
                                    <p class="m-b-20"><?=substr($eventsRow['description'], 0, 100);?>...</p>
                                    <div class="text-right">
                                        <a class="btn btn-primary btn-tone custom-class font-weight-semibold" href="<?=base_url('rhrc/registration/'); ?>"
                                            <span>Register</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#ul-three").addClass("open");
        $("#li-reg-links").addClass("active");
    });
</script>

            <?= $this->endSection() ?>
