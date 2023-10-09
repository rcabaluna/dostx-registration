<?= $this->extend('templates/main-admin') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <div class="page-header">
        <h2 class="header-title">Evaluation Form QR Codes/Links</h2>
    </div>
    <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img class="img-fluid" src="<?=base_url('assets/images/evaluation/day1.png')?>" alt="">
                                </div>
                                <div class="col-md-8">
                                    <h5 class="m-b-10 text-dark"><b>Day 1 : Opening Ceremony and Student Category Competitions</b></h5>
                                                                    <div class="text-right">
                                        <a class="btn btn-primary btn-tone custom-class font-weight-semibold" href="<?=base_url('evaluation?event=day1')?>">
                                            <span>Evaluate</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img class="img-fluid" src="<?=base_url('assets/images/evaluation/day2.png')?>" alt="">
                                </div>
                                <div class="col-md-8">
                                    <h5 class="m-b-10 text-dark"><b>Day 2 : Plenary Session and Professional Category Competitions</b></h5>
                                                                    <div class="text-right">
                                        <a class="btn btn-primary btn-tone custom-class font-weight-semibold" href="<?=base_url('evaluation?event=day2')?>">
                                            <span>Evaluate</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img class="img-fluid" src="<?=base_url('assets/images/evaluation/day3.png')?>" alt="">
                                </div>
                                <div class="col-md-8">
                                    <h5 class="m-b-10 text-dark"><b>Day 3 : Closing and Awarding Ceremonies</b></h5>
                                                                    <div class="text-right">
                                        <a class="btn btn-primary btn-tone custom-class font-weight-semibold" href="<?=base_url('evaluation?event=day3')?>">
                                            <span>Evaluate</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#ul-six").addClass("open");
        $("#li-evaluation-links").addClass("active");
    });
</script>

            <?= $this->endSection() ?>
