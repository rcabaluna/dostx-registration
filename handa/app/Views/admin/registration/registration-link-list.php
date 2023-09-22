<?= $this->extend('templates/main-admin') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Registration QR Codes/Links (Pre-register)</h2>
        <?php if (isset($_SESSION['update'])) {
            ?>
            <div class="mt-3 alert alert-success alert-dismissible fade show" id="alert-update-status">
                <div class="d-flex align-items-center justify-content-start">
                    <span class="alert-icon">
                        <i class="anticon anticon-check-o"></i>
                    </span>
                    <span>The registration status has been updated successfully!</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <?php }
        ?>


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
                                    <img class="img-fluid" src="<?=base_url('assets/images/programs/'.$eventsRow['shorthand'].'.png')?>" alt="">
                                </div>
                                <div class="col-md-8">
                                    <h5 class="m-b-10 text-dark"><b> <?=$eventsRow['name']?></b>
                                        <?php
                                            if ($eventsRow['is_closed']) {
                                                ?>
                                                <span class="text-danger">(Closed)</span>
                                                <?php
                                            }else{
                                                ?>
                                                <span class="text-success">(Open)</span>
                                                <?php
                                            }
                                        ?>
                                    </h5>
                                    <div class="d-flex align-items-center m-t-5 m-b-15">
                                        <div class="m-l-10">
                                            <span class="text-gray font-weight-semibold"><?=$eventsRow['venue']?></span>
                                            <span class="m-h-5 text-gray">|</span>
                                            <span class="text-gray"><?=$eventsRow['datetime']?></span>
                                        </div>
                                    </div>
                                    <p class="m-b-20"><?=substr($eventsRow['description'], 0, 100);?>...</p>
                                    <div class="text-right">
                                        <a class="btn btn-primary btn-tone custom-class font-weight-semibold" href="<?=base_url('/registration/event/'.$eventsRow['shorthand'])?>">
                                            <span>Go</span>
                                        </a>
                                    <?php
                                        if ($eventsRow['is_closed'] == 0) {
                                            ?>
                                            <a class="btn btn-danger btn-tone custom-class font-weight-semibold" href="<?=base_url('/registration/change-status/c/'.$eventsRow['shorthand'])?>">
                                            <span>Close Registration</span></a>
                                            <?php
                                        }else{
                                            ?>
                                            <a class="btn btn-info btn-tone custom-class font-weight-semibold" href="<?=base_url('/registration/change-status/o/'.$eventsRow['shorthand'])?>">
                                            <span>Open Registration</span></a>
                                            <?php
                                        }
                                    ?>
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
