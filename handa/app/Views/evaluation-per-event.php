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
                                
                                <fieldset class="form-group col-md-6">
                                    
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
                                </fieldset>
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
                                        10. <b>I spent an acceptable amount of time to complete this training. (Responsiveness) <small class="text-danger">*</small></b> <br />
                                        <i>(Ako ay gumugugol ng sapat na oras para makompleto ang pagsasanay na ito)</i>
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="responsiveness1" name="responsiveness" value="1" >
                                        <label for="responsiveness1">1</label>
                                        <input type="radio" id="responsiveness2" name="responsiveness" value="2">
                                        <label for="responsiveness2">2</label>
                                        <input type="radio" id="responsiveness3" name="responsiveness" value="3">
                                        <label for="responsiveness3">3</label>
                                        <input type="radio" id="responsiveness4" name="responsiveness" value="4">
                                        <label for="responsiveness4">4</label>
                                        <input type="radio" id="responsiveness5" name="responsiveness" value="5">
                                        <label for="responsiveness5">5</label>
                                        <p class="text-left">Strongly Disagree <span class="float-right">Strongly Agree</span></p>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        11. <b>The office accurately informed and followed the training’s requirements and steps. (Reliability) <small class="text-danger">*</small></b> <br />
                                        <i>(Ang opisina ay masuring sumusunod sa panuntunan ng pagsasanay na ito)</i>
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="reliability1" name="reliability" value="1" >
                                        <label for="reliability1">1</label>
                                        <input type="radio" id="reliability2" name="reliability" value="2">
                                        <label for="reliability2">2</label>
                                        <input type="radio" id="reliability3" name="reliability" value="3">
                                        <label for="reliability3">3</label>
                                        <input type="radio" id="reliability4" name="reliability" value="4">
                                        <label for="reliability4">4</label>
                                        <input type="radio" id="reliability5" name="reliability" value="5">
                                        <label for="reliability5">5</label>
                                        <p class="text-left">Strongly Disagree <span class="float-right">Strongly Agree</span></p>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        12. <b>My training process (including steps) was simple and convenient. (Access and Facilities) <small class="text-danger">*</small></b> <br />
                                        <i>(Ang mga hakbangan sa pagsasanay ay simple at madali.)</i>
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="access_and_facilities1" name="access_and_facilities" value="1" >
                                        <label for="access_and_facilities1">1</label>
                                        <input type="radio" id="access_and_facilities2" name="access_and_facilities" value="2">
                                        <label for="access_and_facilities2">2</label>
                                        <input type="radio" id="access_and_facilities3" name="access_and_facilities" value="3">
                                        <label for="access_and_facilities3">3</label>
                                        <input type="radio" id="access_and_facilities4" name="access_and_facilities" value="4">
                                        <label for="access_and_facilities4">4</label>
                                        <input type="radio" id="access_and_facilities5" name="access_and_facilities" value="5">
                                        <label for="access_and_facilities5">5</label>
                                        <p class="text-left">Strongly Disagree <span class="float-right">Strongly Agree</span></p>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        13. <b>I easily found information about the training from the office staff or internet. (Communication) <small class="text-danger">*</small></b> <br />
                                        <i>(Ang impormasyon tungkol sa pagsasanay ay madali kong malaman sa mga empleyado o sa internet.)</i>
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="communication1" name="communication" value="1" >
                                        <label for="communication1">1</label>
                                        <input type="radio" id="communication2" name="communication" value="2">
                                        <label for="communication2">2</label>
                                        <input type="radio" id="communication3" name="communication" value="3">
                                        <label for="communication3">3</label>
                                        <input type="radio" id="communication4" name="communication" value="4">
                                        <label for="communication4">4</label>
                                        <input type="radio" id="communication5" name="communication" value="5">
                                        <label for="communication5">5</label>
                                        <p class="text-left">Strongly Disagree <span class="float-right">Strongly Agree</span></p>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        14. <b>I did not pay any fees for this training. (Cash) <small class="text-danger">*</small></b> <br />
                                        <i>(Ako ay walang binayaran sa pagsasanay na ito.)</i>
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="cash1" name="cash" value="1" >
                                        <label for="cash1">1</label>
                                        <input type="radio" id="cash2" name="cash" value="2">
                                        <label for="cash2">2</label>
                                        <input type="radio" id="cash3" name="cash" value="3">
                                        <label for="cash3">3</label>
                                        <input type="radio" id="cash4" name="cash" value="4">
                                        <label for="cash4">4</label>
                                        <input type="radio" id="cash5" name="cash" value="5">
                                        <label for="cash5">5</label>
                                        <p class="text-left">Strongly Disagree <span class="float-right">Strongly Agree</span></p>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        15. <b>I am confident this training was secure. (Integrity) <small class="text-danger">*</small></b> <br />
                                        <i>(Ako ay tiwalang ang pagsasanay ay ligtas.)</i>
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="integrity1" name="integrity" value="1" >
                                        <label for="integrity1">1</label>
                                        <input type="radio" id="integrity2" name="integrity" value="2">
                                        <label for="integrity2">2</label>
                                        <input type="radio" id="integrity3" name="integrity" value="3">
                                        <label for="integrity3">3</label>
                                        <input type="radio" id="integrity4" name="integrity" value="4">
                                        <label for="integrity4">4</label>
                                        <input type="radio" id="integrity5" name="integrity" value="5">
                                        <label for="integrity5">5</label>
                                        <p class="text-left">Strongly Disagree <span class="float-right">Strongly Agree</span></p>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        16. <b>The office staff was quick to respond to my queries. (Assurance) <small class="text-danger">*</small></b> <br />
                                        <i>(Ako ay tiwalang ang pagsasanay ay ligtas.)</i>
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="assurance1" name="assurance" value="1" >
                                        <label for="assurance1">1</label>
                                        <input type="radio" id="assurance2" name="assurance" value="2">
                                        <label for="assurance2">2</label>
                                        <input type="radio" id="assurance3" name="assurance" value="3">
                                        <label for="assurance3">3</label>
                                        <input type="radio" id="assurance4" name="assurance" value="4">
                                        <label for="assurance4">4</label>
                                        <input type="radio" id="assurance5" name="assurance" value="5">
                                        <label for="assurance5">5</label>
                                        <p class="text-left">Strongly Disagree <span class="float-right">Strongly Agree</span></p>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        17. <b>I got what I needed from this government office (Outcome) <small class="text-danger">*</small></b> <br />
                                        <i>(Nakuha ko ang kasagutan sa aking pakay sa opisinang ito.)</i>
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="outcome1" name="outcome" value="1" >
                                        <label for="outcome1">1</label>
                                        <input type="radio" id="outcome2" name="outcome" value="2">
                                        <label for="outcome2">2</label>
                                        <input type="radio" id="outcome3" name="outcome" value="3">
                                        <label for="outcome3">3</label>
                                        <input type="radio" id="outcome4" name="outcome" value="4">
                                        <label for="outcome4">4</label>
                                        <input type="radio" id="outcome5" name="outcome" value="5">
                                        <label for="outcome5">5</label>
                                        <p class="text-left">Strongly Disagree <span class="float-right">Strongly Agree</span></p>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="form-row" id="css-feedback-form-2">
                                <div class="form-group col-md-12">
                                    <h4>CUSTOMER SATISFACTION FEEDBACK - HANDA PILIPINAS 2023</h4>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        18.
                                        <b>
                                            OVERALL SATISFACTION (Pangkalahatang Kasiyahan) <small class="text-danger">*</small><br /><br />
                                            Please select your responses using the following rating scale (5-excellent and 1-Poor)
                                        </b>
                                        <br />
                                        <i>(Piliin ang iyong puna gamit ang mga sumusunod na marka (5-Mahusay at higit pa sa inaasahan at 1-Wala o maling natugunan.)</i>
                                    </label>
                                    <fieldset class="radio-toolbar mt-3">
                                        <input type="radio" id="overall_satisfaction1" name="overall_satisfaction" value="1">
                                        <label for="overall_satisfaction1">1</label>
                                        <input type="radio" id="overall_satisfaction2" name="overall_satisfaction" value="2">
                                        <label for="overall_satisfaction2">2</label>
                                        <input type="radio" id="overall_satisfaction3" name="overall_satisfaction" value="3">
                                        <label for="overall_satisfaction3">3</label>
                                        <input type="radio" id="overall_satisfaction4" name="overall_satisfaction" value="4">
                                        <label for="overall_satisfaction4">4</label>
                                        <input type="radio" id="overall_satisfaction5" name="overall_satisfaction" value="5">
                                        <label for="overall_satisfaction5">5</label>
                                        <p class="text-left">Poor <span class="float-right">Excellent</span></p>
                                    </fieldset>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        19. <b>If you rated 2-Fair or 1-Poor in the OVERALL SATISFACTION, may we know the reason so that we can improve our services?</b> <br />
                                        <i>(Magbigay ng komento o mungkahi para sa mga rating na 2-fair o 1-Poor upang mas mapabuti pa ang aming mga serbisyo)</i>
                                    </label>
                                    <input type="text" class="form-control" name="if_fair_poor" placeholder="Your answer" />
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        20. <b>If you rated 5-Excellent in the OVERALL SATISFACTION, we would appreciate your feedback to improve our services continuously.</b> <br />
                                        <i>(Magbigay ng komento o mungkahi para sa mga rating na 5-Excellent upang tuloy-tuloy na mapabuti ang aming mga serbisyo.)</i>
                                    </label>
                                    <input type="text" class="form-control" name="if_excellent" placeholder="Your answer" />
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        21. <b>Considering your complete experience with our agency, how likely would you recommend our services to others? </b> <br />
                                        <i>(Base sa inyong pangkalahatang karanasan sa aming ahensya, gaano mo inirekomenda ang aming mga serbisyo?)</i>
                                    </label>
                                    <div class="radio">
                                        <input id="recommend1" name="recommend" type="radio" value="Strongly Recommend"/>
                                        <label for="recommend1">Strongly Recommend</label>
                                    </div>
                                    <div class="radio">
                                        <input id="recommend2" name="recommend" type="radio" value="Will Recommend"/>
                                        <label for="recommend2">Will Recommend</label>
                                    </div>
                                    <div class="radio">
                                        <input id="recommend3" name="recommend" type="radio" value="Neutral"/>
                                        <label for="recommend3">Neutral</label>
                                    </div>
                                    <div class="radio">
                                        <input id="recommend4" name="recommend" type="radio" value=">Will Not Recommend"/>
                                        <label for="recommend4">Will Not Recommend</label>
                                    </div>
                                    <div class="radio">
                                        <input id="recommend5" name="recommend" type="radio" value="Strongly Not Recommend"/>
                                        <label for="recommend5">Strongly Not Recommend</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        22. <b>Other request/s or services needed </b> <br />
                                        <i>(Iba pang tulong o serbisyong nais isangguni)</i>
                                    </label>
                                    <input type="text" class="form-control" name="other_request" placeholder="Your answer" />
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">
                                        23. <b>Is there a technology presented this morning you are interested in? </b> <br />
                                        <i>We can link you using the information you shared with us</i>
                                    </label>
                                    <input type="text" class="form-control" name="interest_technology" placeholder="Your answer" />
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">24. <b>Do you have other questions you were not able to relay during the forum? If so, you can share it here and we’ll try to get back to you.</b> <br /> </label>
                                    <input type="text" class="form-control" name="other_questions" placeholder="Your answer" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <button type="button" id="back-btn" onclick="go_previous_form()" class="btn btn-default btn-tone">Back</button>
                                    <button type="submit" id="next-btn-1" class="btn btn-danger float-right">Next</button>
                                    <button type="submit" id="next-btn-2" class="btn btn-danger float-right">Next</button>
                                    <button type="submit" id="submit-btn" class="btn btn-danger float-right">Submit</button>
                                </div>
                            </div>
                        </form>
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
            $("#css-feedback-form-2").hide();
            $("#next-btn-1").attr("disabled", true);

            $("#back-btn").hide();
        });

        function show_next_btn(){
            if (nextCounter == 1) {
                nextCounter+=1;
                $("#next-btn-1").hide();
                $("#next-btn-2").show();
                $("#submit-btn").hide();
                $("#personal-info-form").hide();
                $("#css-feedback-form-1").show();
                $('html,body').scrollTop(0);
                $("#back-btn").show();

            }else if(nextCounter == 2){
                nextCounter+=1;
                $("#next-btn-1").hide();
                $("#next-btn-2").hide();
                $("#submit-btn").show();
                $("#css-feedback-form-1").hide();
                $("#css-feedback-form-2").show();
                $('html,body').scrollTop(0);
                $("#back-btn").show();
            }else{

            }
        }

        function show_registration_details(){
            $("#registration-form-container").show();
            $("#privacy-notice-container").hide();
            $(window).scrollTop(0);
        }

        function get_provinces_list(){
            var regCode = $("#seladdress-region").val();

            $.get("<?=base_url('get-provinces-list')?>",{
                regCode:regCode
            },function(data){
                $("#seladdress-provinces").html(data);
            });
        }

        $("#evaluation-form").submit(function (e) { 
            if (nextCounter != 3) {
                show_next_btn();
            }else{
                evaluation_process();
            }
            
            e.preventDefault();
            
        });

        $("input[name='infoentered']").on('change', function () {
            if ($("input[name='infoentered']:checked").val() == "Yes") {
                $("#next-btn-1").prop("disabled", false);
                
            }else{
                $("#next-btn-1").prop("disabled", "disabled");
            }
        });

        function go_previous_form(){
            if (nextCounter == 2) {
                $("#personal-info-form").show();
                $("#css-feedback-form-1").hide();
                $(window).scrollTop(0);
                $("#back-btn").hide();
                nextCounter-=1;   
            }else if(nextCounter == 3){
                $("#css-feedback-form-1").show();
                $("#css-feedback-form-2").hide();
                $(window).scrollTop(0);
                nextCounter-=1;   
            }
        }   

        function evaluation_process(){
                $.post("<?=base_url('evaluation-process')?>",{
                    data:$("#evaluation-form").serializeArray()
                },function(data){
                    console.log(data);
                    // if (data == "EXISTS") {
                    //     $("#exists-alert").show();
                    //     $(window).scrollTop(0);
                    // }else{
                    //     window.location.href = '<?=base_url('qr-code/')?>'+data;
                    // }
                });

        }

    </script>
<?= $this->endSection() ?>
