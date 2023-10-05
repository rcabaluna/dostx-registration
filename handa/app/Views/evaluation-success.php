<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<style>
    p{
        color: #2a2a2a !important;
    }

.radio-toolbar {
    text-align: center;
}
.radio-toolbar input[type="radio"] {
    display: none;
    text-align: center;
}

.radio-toolbar label {
    display: inline-block;
    background-color: #ddd;
    padding: 8px 8%;
    font-size: 16px;
    cursor: pointer;
    color: #53535f;
}

.radio-toolbar input[type="radio"]:checked+label {
    background-color: #de4436;
    color: white;

}
</style>
<div class="container d-flex h-100">
        <div class="row align-items-center w-100" style="margin-left: 0px;">
            <div class="col-md-12 col-lg-12 m-h-auto">
                <div class="card shadow-lg">
                    <div class="card-body" style="padding: 1rem; ">
                        <div class="align-items-center justify-content-between m-b-30">
                            <div class="row">
                                <div class="col-12">
                                    <img class="img-fluid" src="<?=base_url('assets/images/logo/handa-logo-black.png')?>">
                                <div class="mt-3 col-12">
                                    <p class="text-dark">Thank you for taking the time to complete the evaluation form for <b><?=$eventx['name'];?></b>.</p>
                                    <p class="text-dark">Your feedback is incredibly important to us, and we truly value your insights.</p>
                                    <p class="text-dark">If you ever have questions or require assistance, please feel free to reach out to us at <a href="mailto: handapilipinas@region10.dost.gov.ph">handapilipinas@region10.dost.gov.ph</a>. We're here to help.</p>
                                    <p class="text-dark">Once again, thank you for participating in this event. Your contributions are highly valued, and we look forward to serving you in future events.</p>
                                </div>
                               <?php if($eventx['shorthand'] != 'opening-ceremony' && $eventx['shorthand'] && $eventx['fnriforum'] != 'presscon' && $eventx['shorthand'] != 'mousigning' && $eventx['shorthand'] != 'closing-ceremony' && $eventx['shorthand'] != 'drrm-exhibits'){
                                ?>
                                 <div class="col-md-12 mt-3 text-center">
                                    <a class="btn btn-danger custom-class" href="<?=base_url('certificates/cp?certnumber='.$certnumber)?>" target="_blank">
                                        Download Certificate
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
