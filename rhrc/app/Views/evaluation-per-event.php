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
    background-color: #3f87f5;
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
                            <div class="form-row" id="personal-info-form">
                                <h3>Personal Information</h3>
                                <div class="form-group col-md-12">
                                    <label class="font-weight-semibold">1. Title (e.g. Dr., Mr., Mrs.) <small class="text-danger">*</small></label>
                                    <input type="hidden" value="<?=$eventx['shorthand']?>" name="event">
                                    <select name="title" class="form-control"  >
                                        <option value=""></option>
                                        <option value="Mr.">Mr.</option>
                                        <option value="Ms.">Ms.</option>
                                        <option value="Mrs.">Mrs.</option>
                                        <option value="Dr.">Dr.</option>
                                        <option value="Engr.">Engr.</option>
                                        <option value="Atty.">Atty.</option>
                                        <option value="Mx.">Mx.</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="font-weight-semibold">2. Full Name <small>(Firstname, Middle Initial, Surname, Suffix)</small> <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control" name="fullname" placeholder="Full Name"  />
                                    <label for="inputEmail4"><i>Please ensure correct spelling.</i></label>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label">3. Affiliation <small>(Name of Organization/Institution)</small> <small class="text-danger">*</small></label>
                                    <input type="text" name="agency_name" class="form-control" placeholder="Name of Organization/Institution"  />
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">4. Email Address <small>(To receive the certificate)</small> <small class="text-danger">*</small></label>
                                    <input type="email" class="form-control" name="email" placeholder="Email Address"  />
                                    <label for="inputEmail4"><i>Please double check the entry.</i></label>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">5. Gender <small class="text-danger">*</small></label>
                                    <select class="form-control" name="sex"  >
                                        <option value=""></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Prefer not to say">Prefer not to say</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">6.1 Address (Region) <small class="text-danger">*</small></label>
                                    <select class="form-control" name="address_region" id="seladdress-region" onchange="get_provinces_list()"  >
                                        <option value=""></option>
                                        <?php foreach ($regions as $regionsRow) {
                                                            ?>
                                        <option value="<?=$regionsRow['regCode']?>"><?=$regionsRow['regDesc']?></option>
                                        <?php
                                                        }?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">6.2 Address (Province) <small class="text-danger">*</small></label>
                                    <select class="form-control" id="seladdress-provinces" name="address_province"  >
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">7. Privileges <small>(check all that applies)</small></label>
                                    <div class="checkbox">
                                        <input id="checkbox1" type="checkbox" value="PWD" name="privileges[]" />
                                        <label for="checkbox1">PWD</label>
                                    </div>
                                    <div class="checkbox">
                                        <input id="checkbox2" type="checkbox" value="Solo Parent" name="privileges[]" />
                                        <label for="checkbox2">Solo Parent</label>
                                    </div>
                                    <div class="checkbox">
                                        <input id="checkbox3" type="checkbox" value="Senior Citizen" name="privileges[]" />
                                        <label for="checkbox3">Senior Citizen</label>
                                    </div>
                                    <div class="checkbox">
                                        <input id="checkbox4" type="checkbox" value="IP" name="privileges[]" />
                                        <label for="checkbox4">IP</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="infoentered">8. I have entered TRUE and COMPLETE information. <small class="text-danger">*</small></label>
                                    <div class="radio">
                                        <input id="radio1" name="infoentered" type="radio" value="Yes" />
                                        <label for="radio1">Yes</label>
                                    </div>
                                    <div class="radio">
                                        <input id="radio2" name="infoentered" type="radio" value="No" />
                                        <label for="radio2">No</label>
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="sourceinfo">9. How/Where did you learn about this forum/event? <small class="text-danger">*</small></label>
                                        
                                        <div class="radio">
                                            <input id="radio3"  value="Referral" name="sourceinfo" type="radio" />
                                            <label for="radio3">Referral</label>
                                        </div>
                                        <div class="radio">
                                            <input id="radio4"  value="Invitation from my organization" name="sourceinfo" type="radio" />
                                            <label for="radio4">Invitation from my organization</label>
                                        </div>
                                        <div class="radio">
                                            <input id="radio5"  value="Social Media (FB/Twitter/Instagram)" name="sourceinfo" type="radio" />
                                            <label for="radio5">Social Media (FB/Twitter/Instagram)</label>
                                        </div>
                                        <div class="radio">
                                            <input id="radio6"  value="Fairs and Exhibits" name="sourceinfo" type="radio" />
                                            <label for="radio6">Fairs and Exhibits</label>
                                        </div>
                                        <div class="radio">
                                            <input id="radio7"  value="DOST-X Website" name="sourceinfo" type="radio" />
                                            <label for="radio7">DOST-X Website</label>
                                        </div>
                                        <div class="radio">
                                            <input id="radio8"  value="TV/Radio" name="sourceinfo" type="radio" />
                                            <label for="radio8">TV/Radio</label>
                                        </div>
                                        <div class="radio">
                                            <input id="radio9"  value="Print (Newspapers/Magazine)" name="sourceinfo" type="radio" />
                                            <label for="radio9">Print (Newspapers/Magazine)</label>
                                        </div>
                                        <div class="radio">
                                            <input id="radio10"  value="Online/Google" name="sourceinfo" type="radio" />
                                            <label for="radio10">Online/Google</label>
                                        </div>
                                        <div class="radio">
                                            <input id="radio11"  value="Brochures/Flyers/Newsletter" name="sourceinfo" type="radio" />
                                            <label for="radio11">Brochures/Flyers/Newsletter</label>
                                        </div>
                                </div>
                            </div>
                            <div class="form-row" id="css-feedback-form-1">
                                <div class="form-group col-md-12">
                                    <h4>CUSTOMER SATISFACTION FEEDBACK - HANDA PILIPINAS 2023</h4>
                                    <p>
                                        How will you rate our service? <br />
                                        <i>(Paano mo mamarkahan ang aming serbisyo?)</i>
                                    </p>
                                    <p><b>INSTRUCTION: For Service Quality Dimension</b></p>
                                    <p><b>Please select your responses using the following rating scale (5-strongly agree, 4-agree, 3-neutral, 2-disagree, 1-strongly disagree).</b></p>
                                    <p>Piliin ang iyong puna gamit ang mga sumusunod na marka (5- higit na sumasang-ayon, 4-sumasangayos, 3-hindi tiyak ang sagot, 2-hindi sang-ayon, 1-mariing tumututol).</p>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        10. <b>Do you think holding this activity is necessary? <small class="text-danger">*</small></b> <br />
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="q10-1" name="q10" value="1" >
                                        <label for="q10-1">Yes</label>
                                        <input type="radio" id="q10-2" name="q10" value="0">
                                        <label for="q10-2">No</label>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        11. <b>Is the purpose of the activity clear to you? <small class="text-danger">*</small></b> <br />
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="q11-1" name="q11" value="1" >
                                        <label for="q11-1">Yes</label>
                                        <input type="radio" id="q11-2" name="q11" value="0">
                                        <label for="q11-2">No</label>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        12. <b>Do you think the objective of the activity was achieved? <small class="text-danger">*</small></b> <br />
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="q12-1" name="q12" value="1" >
                                        <label for="q12-1">Yes</label>
                                        <input type="radio" id="q12-2" name="q12" value="0">
                                        <label for="q12-2">No</label>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        13. <b>How do you find the management of the activity in terms of:</b>
                                    </label>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        a. <b>OVERALL MANAGEMENT <small class="text-danger">*</small></b> <br />
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="q13a-1" name="q13a" value="1" >
                                        <label for="q13a-1">1</label>
                                        <input type="radio" id="q13a-2" name="q13a" value="2">
                                        <label for="q13a-2">2</label>
                                        <input type="radio" id="q13a-3" name="q13a" value="3">
                                        <label for="q13a-3">3</label>
                                        <input type="radio" id="q13a-4" name="q13a" value="4">
                                        <label for="q13a-4">4</label>
                                        <input type="radio" id="q13a-5" name="q13a" value="5">
                                        <label for="q13a-5">5</label>
                                        <p class="text-left">Strongly Disagree <span class="float-right">Strongly Agree</span></p>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        b. <b>PLATFORM <small class="text-danger">*</small></b> <br />
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="q13b-1" name="q13b" value="1" >
                                        <label for="q13b-1">1</label>
                                        <input type="radio" id="q13b-2" name="q13b" value="2">
                                        <label for="q13b-2">2</label>
                                        <input type="radio" id="q13b-3" name="q13b" value="3">
                                        <label for="q13b-3">3</label>
                                        <input type="radio" id="q13b-4" name="q13b" value="4">
                                        <label for="q13b-4">4</label>
                                        <input type="radio" id="q13b-5" name="q13b" value="5">
                                        <label for="q13b-5">5</label>
                                        <p class="text-left">Strongly Disagree <span class="float-right">Strongly Agree</span></p>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        c. <b>TRAINER/RESOURCE SPEAKER  <small class="text-danger">*</small></b> <br />
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="q13c-1" name="q13c" value="1" >
                                        <label for="q13c-1">1</label>
                                        <input type="radio" id="q13c-2" name="q13c" value="2">
                                        <label for="q13c-2">2</label>
                                        <input type="radio" id="q13c-3" name="q13c" value="3">
                                        <label for="q13c-3">3</label>
                                        <input type="radio" id="q13c-4" name="q13c" value="4">
                                        <label for="q13c-4">4</label>
                                        <input type="radio" id="q13c-5" name="q13c" value="5">
                                        <label for="q13c-5">5</label>
                                        <p class="text-left">Strongly Disagree <span class="float-right">Strongly Agree</span></p>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        d. <b>SECRETARIAT/FACILITATOR <small class="text-danger">*</small></b> <br />
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="q13d-1" name="q13d" value="1" >
                                        <label for="q13d-1">1</label>
                                        <input type="radio" id="q13d-2" name="q13d" value="2">
                                        <label for="q13d-2">2</label>
                                        <input type="radio" id="q13d-3" name="q13d" value="3">
                                        <label for="q13d-3">3</label>
                                        <input type="radio" id="q13d-4" name="q13d" value="4">
                                        <label for="q13d-4">4</label>
                                        <input type="radio" id="q13d-5" name="q13d" value="5">
                                        <label for="q13d-5">5</label>
                                        <p class="text-left">Strongly Disagree <span class="float-right">Strongly Agree</span></p>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        e. <b>PROGRAM <small class="text-danger">*</small></b> <br />
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="q13e-1" name="q13e" value="1" >
                                        <label for="q13e-1">1</label>
                                        <input type="radio" id="q13e-2" name="q13e" value="2">
                                        <label for="q13e-2">2</label>
                                        <input type="radio" id="q13e-3" name="q13e" value="3">
                                        <label for="q13e-3">3</label>
                                        <input type="radio" id="q13e-4" name="q13e" value="4">
                                        <label for="q13e-4">4</label>
                                        <input type="radio" id="q13e-5" name="q13e" value="5">
                                        <label for="q13e-5">5</label>
                                        <p class="text-left">Strongly Disagree <span class="float-right">Strongly Agree</span></p>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        f. <b>TIME ALLOCATION <small class="text-danger">*</small></b> <br />
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="q13f-1" name="q13f" value="1" >
                                        <label for="q13f-1">1</label>
                                        <input type="radio" id="q13f-2" name="q13f" value="2">
                                        <label for="q13f-2">2</label>
                                        <input type="radio" id="q13f-3" name="q13f" value="3">
                                        <label for="q13f-3">3</label>
                                        <input type="radio" id="q13f-4" name="q13f" value="4">
                                        <label for="q13f-4">4</label>
                                        <input type="radio" id="q13f-5" name="q13f" value="5">
                                        <label for="q13f-5">5</label>
                                        <p class="text-left">Strongly Disagree <span class="float-right">Strongly Agree</span></p>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        14. <b>What have you learned from the activity?</b> <br /> </label>
                                    <input type="text" class="form-control" name="learnings" placeholder="Your answer" />
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        15. <b>What improvement can you suggest?</b> <br /> </label>
                                    <input type="text" class="form-control" name="suggestions" placeholder="Your answer" />
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        16. <b>Would you like an electronic copy of your Certificate of Appearance? If not, please proceed to the registration area to request a hard copy.</b> <small class="text-danger">*</small> <br />
                                    </label>
                                    <div class="radio">
                                        <input id="eca1" name="ecacopy" type="radio" value="1"/>
                                        <label for="eca1">Yes</label>
                                    </div>
                                    <div class="radio">
                                        <input id="eca2" name="ecacopy" type="radio" value="0"/>
                                        <label for="eca2">No</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <button type="button" id="back-btn" onclick="go_previous_form()" class="btn btn-default btn-tone">Back</button>
                                    <button type="submit" id="next-btn-1" class="btn btn-primary float-right" disabled>Next</button>
                                    <button type="submit" id="submit-btn" class="btn btn-primary float-right"disabled><i class="anticon anticon-loading m-r-5"></i></i>Submit</button>
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
        $("#next-btn-2").hide();
        $("#submit-btn").hide();
        $("#personal-info-form").show();
        $("#css-feedback-form-1").hide();
        $("#back-btn").hide();

        // Attach the function to the change event of inputs and selects in #personal-info-form
        $("#personal-info-form input, #personal-info-form select").change(checkInputs_personal_info);

        checkInputs_personal_info();
    });

    // FORM VALIDATION PART 1
    function checkInputs_personal_info() {
        var allInputsFilled = true;
        $("#personal-info-form input, #personal-info-form select").each(function () {
            if ($(this).val() === "" || $(this).val() === null) {
                allInputsFilled = false;
                return false;
            }
        });

        var infoEntered = $('input[name="infoentered"]:checked').val() === "Yes";
        var sourceInfoSelected = $('input[name="sourceinfo"]:checked').val() !== undefined;

        if (allInputsFilled && infoEntered && sourceInfoSelected) {
            $("#next-btn-1").prop("disabled", false);
        } else {
            $("#next-btn-1").prop("disabled", true);
        }
    }

    // FORM VALIDATION CSS 1
    $('#css-feedback-form-1 input[type="radio"]').change(checkInputs_css_part_1);
    function checkInputs_css_part_1() {
        var distinctRadioNames = {};

        $('#css-feedback-form-1 input[type="radio"]').each(function() {
            distinctRadioNames[this.name] = true;
        });

        var totalDistinctRadioNames = Object.keys(distinctRadioNames).length;
        var totalSelectedRadioButtons = $('#css-feedback-form-1 input[type="radio"]:checked').length;

        if (totalSelectedRadioButtons === totalDistinctRadioNames) {
            $('#submit-btn').prop('disabled', false);
        } else {
            $('#submit-btn').prop('disabled', true);
        }
    }

    function show_next_btn() {
        if (nextCounter == 1) {
            nextCounter += 1;
            $("#next-btn-1").hide();
            $("#submit-btn").show();
            $("#personal-info-form").hide();
            $("#css-feedback-form-1").show();
            $("html,body").scrollTop(0);
            $("#back-btn").show();
            checkInputs_personal_info();
            checkInputs_css_part_1();
        }
    }

    function show_registration_details() {
        $("#registration-form-container").show();
        $("#privacy-notice-container").hide();
        $(window).scrollTop(0);
    }

    function get_provinces_list() {
        var regCode = $("#seladdress-region").val();

        $.get(
            "<?=base_url('get-provinces-list')?>",
            {
                regCode: regCode,
            },
            function (data) {
                $("#seladdress-provinces").html(data);
            }
        );
    }

    $("#evaluation-form").submit(function (e) {
        if (nextCounter != 2) {
            show_next_btn();
        } else {
            evaluation_process();
        }

        e.preventDefault();
    });

    function go_previous_form() {
        if (nextCounter == 2) {
            $("#personal-info-form").show();
            $("#css-feedback-form-1").hide();
            $(window).scrollTop(0);
            $("#back-btn").hide();
            $("#next-btn-1").show();
            $("#submit-btn").hide();
            checkInputs_personal_info();
            nextCounter -= 1;
        }
    }

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