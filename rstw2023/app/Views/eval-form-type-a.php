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
    padding: 8px 7%;
    font-size: 16px;
    cursor: pointer;
    color: #53535f;
    text-align: center;
}

.radio-toolbar input[type="radio"]:checked+label {
    background-color: #00c9a7;
    color: white;

}
</style>
<div class="container d-flex h-100 px-0">
    <div class="row align-items-center w-100" style="margin-left: 0px;">
        <div class="col-md-12 col-lg-12 m-h-auto">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="row">
                            <div class="col-12"><img class="img-fluid" src="<?=base_url("assets/images/logo/handa-logo-black.png");?>"></div>
                            <div id="privacy-notice-container">
                                <div class="mt-3 col-12">
                                    <div id="event-title">
                                        <h3>
                                            <b>Evaluation Form:</b>
                                            <?=$eventx['name'];?>
                                        </h3>
                                        <h5>
                                            <b>Venue:</b>
                                            <?=$eventx['venue'];?>
                                        </h5>
                                        <h5>
                                            <b>Date and Time:</b>
                                            <?=$eventx['datetime'];?>
                                        </h5>
                                        <hr />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="evaluation-form-container">
                        <?php if($eventx['eval_expire'] == 1){ ?>
                            <h3 class="text-center mb-3">Evaluation for This Event Is Now Closed</h3>
                            <p>Thank you for your participation in <b><?=$eventx['name'];?></b>. We appreciate your valuable feedback and insights. The evaluation for this event is now closed.</p>

                                <p>If you have any questions or need further assistance, please feel free to contact at <a href="mailto:handapilipinas@region10.dost.gov.ph">handapilipinas@region10.dost.gov.ph</a>.</p>

                            <p>Stay tuned for future events and opportunities to engage with us!</p>
                        <?php }else{ ?>
                            <form id="evaluation-form">
                                <input type="hidden" value="<?=$eventx['shorthand'];?>" name="event">
                            <div class="form-row" id="personal-info-form">
                                <h3>Personal Information</h3>
                                <div class="form-group col-md-12">
                                    <label class="font-weight-semibold">1. Full Name</label>
                                    <input type="text" class="form-control" name="fullname"/>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="font-weight-semibold">2. Office/Company <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="agency_name" required/>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="font-weight-semibold">3. Email Address <small class="text-danger">*</small></label>
                                    <input type="email" class="form-control" name="email" required/>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">4. Sex <small class="text-danger">*</small></label>
                                    <select class="form-control" name="sex" required >
                                        <option value=""></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Prefer not to say">Prefer not to say</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">5. Age <small class="text-danger">*</small></label>
                                    <select class="form-control" name="age" required >
                                        <option value=""></option>
                                        <option value="13-25">13-25</option>
                                        <option value="26-35">26-35</option>
                                        <option value="36-45">36-45</option>
                                        <option value="46-59">46-59</option>
                                        <option value="60 & above">60 & above</option>

                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="sourceinfo">6. How did you learn about this activity? <small class="text-danger">*</small></label>
                                        
                                        <div class="radio">
                                            <input id="radio3"  value="DOST Invitation" name="sourceinfo" type="radio" />
                                            <label for="radio3">DOST Invitation</label>
                                        </div>
                                        <div class="radio">
                                            <input id="radio4"  value="Advertisement" name="sourceinfo" type="radio" />
                                            <label for="radio4">Advertisement <small>(TV, Radio, Newspapers, Poster, Tarpaulins)</small></label>
                                        </div>
                                        <div class="radio">
                                            <input id="radio5"  value="Social Media" name="sourceinfo" type="radio" />
                                            <label for="radio5">Social Media</label>
                                        </div>
                                        <div class="radio">
                                            <input id="radio6"  value="Referral" name="sourceinfo" type="radio" />
                                            <label for="radio6">Referral</label>
                                        </div>
                                        <div class="radio">
                                            <input id="radio6"  value="Others" name="sourceinfo" type="radio" />
                                            <label for="radio6">Others</label>
                                        </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        7. <b>How satisfied are you with the following:</b>
                                    </label>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        a. <b>Promotion of the Activity <small class="text-danger">*</small></b> <br />
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="qa-1" name="qa" value="1" >
                                        <label for="qa-1">1</label>
                                        <input type="radio" id="qa-2" name="qa" value="2">
                                        <label for="qa-2">2</label>
                                        <input type="radio" id="qa-3" name="qa" value="3">
                                        <label for="qa-3">3</label>
                                        <input type="radio" id="qa-4" name="qa" value="4">
                                        <label for="qa-4">4</label>
                                        <input type="radio" id="qa-5" name="qa" value="5">
                                        <label for="qa-5">5</label>
                                        <p class="text-left">Very Dissatisfied <span class="float-right">Very Satisfied</span></p>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        b. <b>Invitation and Registration <small class="text-danger">*</small></b> <br />
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="qb-1" name="qb" value="1" >
                                        <label for="qb-1">1</label>
                                        <input type="radio" id="qb-2" name="qb" value="2">
                                        <label for="qb-2">2</label>
                                        <input type="radio" id="qb-3" name="qb" value="3">
                                        <label for="qb-3">3</label>
                                        <input type="radio" id="qb-4" name="qb" value="4">
                                        <label for="qb-4">4</label>
                                        <input type="radio" id="qb-5" name="qb" value="5">
                                        <label for="qb-5">5</label>
                                        <p class="text-left">Very Dissatisfied <span class="float-right">Very Satisfied</span></p>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        c. <b>Information Materials  <small class="text-danger">*</small></b> <br />
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="qc-1" name="qc" value="1" >
                                        <label for="qc-1">1</label>
                                        <input type="radio" id="qc-2" name="qc" value="2">
                                        <label for="qc-2">2</label>
                                        <input type="radio" id="qc-3" name="qc" value="3">
                                        <label for="qc-3">3</label>
                                        <input type="radio" id="qc-4" name="qc" value="4">
                                        <label for="qc-4">4</label>
                                        <input type="radio" id="qc-5" name="qc" value="5">
                                        <label for="qc-5">5</label>
                                        <p class="text-left">Very Dissatisfied <span class="float-right">Very Satisfied</span></p>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        d. <b>Program Management <small class="text-danger">*</small></b> <br />
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="qd-1" name="qd" value="1" >
                                        <label for="qd-1">1</label>
                                        <input type="radio" id="qd-2" name="qd" value="2">
                                        <label for="qd-2">2</label>
                                        <input type="radio" id="qd-3" name="qd" value="3">
                                        <label for="qd-3">3</label>
                                        <input type="radio" id="qd-4" name="qd" value="4">
                                        <label for="qd-4">4</label>
                                        <input type="radio" id="qd-5" name="qd" value="5">
                                        <label for="qd-5">5</label>
                                        <p class="text-left">Very Dissatisfied <span class="float-right">Very Satisfied</span></p>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        e. <b>Time Management <small class="text-danger">*</small></b> <br />
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="qe-1" name="qe" value="1" >
                                        <label for="qe-1">1</label>
                                        <input type="radio" id="qe-2" name="qe" value="2">
                                        <label for="qe-2">2</label>
                                        <input type="radio" id="qe-3" name="qe" value="3">
                                        <label for="qe-3">3</label>
                                        <input type="radio" id="qe-4" name="qe" value="4">
                                        <label for="qe-4">4</label>
                                        <input type="radio" id="qe-5" name="qe" value="5">
                                        <label for="qe-5">5</label>
                                        <p class="text-left">Very Dissatisfied <span class="float-right">Very Satisfied</span></p>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="font-weight-semibold">8. Comments, if any:</label>
                                    <input type="text" class="form-control" name="comments"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <button type="submit" id="submit-btn" class="btn btn-success float-right" disabled><i class="anticon anticon-loading m-r-5"></i></i>Submit</button>
                                </div>
                            </div>
                        </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<script>
    var nextCounter = 1;

    $(document).ready(function () {
        $("#submit-btn").show();
        $("#personal-info-form").show();

        // Attach the function to the change event of inputs and selects in #personal-info-form
        $("#personal-info-form input, #personal-info-form select").change(checkInputs_personal_info);

        checkInputs_personal_info();
    });

    // FORM VALIDATION PART 1
    function checkInputs_personal_info() {
        $("#personal-info-form input, #personal-info-form select").each(function () {
            if ($(this).val() === "" || $(this).val() === null) {
                allInputsFilled = false;
                return false;
            }
        });

        var overall = $('input[type="radio"]:checked').length > 5;

        if (overall) {
            $("#submit-btn").prop("disabled", false);
        } else {
            $("#submit-btn").prop("disabled", true);
        }
    }

    $("#evaluation-form").submit(function (e) {
            evaluation_process();
        e.preventDefault();
    });

    function evaluation_process() {
        $("#submit-btn").addClass("is-loading");
        setTimeout(function () {
            $("#submit-btn").removeClass("is-loading");
        }, 25000);

        $.post(
            "<?=base_url('evaluation-process')?>",
            {
                data: $("#evaluation-form").serializeArray(),
            },
            function (data) {
                console.log(data);
                var output = data.split("/");
                if (output[0] == "SUCCESS") {
                    window.location.href = '<?=base_url('evaluation-success?certnumber=')?>'+output[1];
                } else {
                    console.log(data);
                }
            }
        );
    }

</script>
<?= $this->endSection() ?>