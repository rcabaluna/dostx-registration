<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<?php $uri = service('uri'); ?>
<style>
    p{
        color: #2a2a2a !important;
    }
</style>
                <div class="container d-flex h-100 px-0">
                    <div class="row align-items-center w-100" style="margin-left: 0px;">
                        <div class="col-md-12 col-lg-12 m-h-auto">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between m-b-30">
                                        <div class="row">
                                            <div class="col-12">
                                                <img class="img-fluid" src="<?=base_url("assets/images/logo/handa-logo-black.png");?>">
                                            </div>
                                            <div id="privacy-notice-container">
                                                <div class="mt-3 col-12">
                                  
                                                         <div id="event-title">
                                                            <h1><b>Title:</b> <?=$eventx['name'];?></h1>
                                                            <h5><b>Venue:</b> <?=$eventx['venue'];?></h5>
                                                            <h5><b>Date and Time:</b> <?=$eventx['datetime'];?></h5>
                                                            <h5><b>Description:</b></h5>
                                                            <div style="color: #2a2a2a !important">
                                                                <?=$eventx['description'];?></div>
                                                            <hr>
                                                        </div>
                                                    <h3 class="mb-3 text-dark">Privacy Notice</h3>
                                                    <p class="text-dark"><b>Introduction</b></p>
                                                    <p class="text-dark mb-4">This Privacy Notice details what information we collect, why we collect it, and what we do with it. <br>Before you enter any personal information, please make sure that you have read and fully understood this Notice.</p>
                                                    <p class="text-dark"><b>Data Collection</b></p>
                                                    <p class="text-dark mb-4">The Department of Science and Technology - Region 10 remain committed to fulfilling its mission of providing science, technology, and innovation-based solutions anchored on ethical public service, contributing to a better quality of life in the Region. To this end, it collects data and information, including personal information, from various subjects, which may be used to identify the needs and opportunities in science, technology, and innovation in the Region. These data/information may also be used to improve further our Agency's programs and services.</p>
                                                    <p class="text-dark"><b>Data Use</b></p>
                                                    <p class="text-dark mb-4">This registration form serves as a means to collect information of the participants for production of statistical results.</p>
                                                    <p class="text-dark"><b>List of Data to be Collected</b></p>
                                                    <p class="text-dark mb-4"> 
                                                        Title
                                                        <br>Complete Name
                                                        <br>Contact Number
                                                        <br>Email Address
                                                        <br>Sex
                                                        <br>Address (Region)
                                                        <br>Name of Agency/Institution
                                                        <br>Position
                                                        <br>Sector or Affiliation
                                                        <br>Previleges
                                                    </p>
                                                    <p class="text-dark"><b>Access and Correction</b></p>
                                                    <p class="text-dark mb-4">All information we collect are treated with utmost confidentiality. Only authorized DOST-X personnel have access to the personal information collected. You have the right to ask for a copy of any personal information the DOST-X holds about you, as well as the right to ask for its correction, if found erroneous, or deletion on reasonable grounds.</p>

                                                    <button class="btn btn-danger float-right custom-class" onclick="show_registration_details()">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3" id="registration-form-container">
                                    <div class="alert alert-danger" id="exists-alert"> You are already registered to this event. Please click <a href="<?=base_url('handa/find-qr');?>">here</a> to check your QR Code. </div>
                                    <h3>Registration Details</h3>
                                    <p class="mb-4">Fill out the form below to register:</p>
                                        <form id="registration-event-form">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label class="font-weight-semibold">Title (e.g. Dr., Mr., Mrs.) <small class="text-danger">*</small></label>
                                                    <input type="hidden" name="event" value="<?=$uri->getSegment(4)?>">
                                                    <select name="title" class="form-control" required>
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
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label class="font-weight-semibold">Last Name <small class="text-danger">*</small></label>
                                                    <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="font-weight-semibold">First Name  <small class="text-danger">*</small></label>
                                                    <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="font-weight-semibold">Middle Initial </label>
                                                    <input type="text" class="form-control" name="middle_initial" placeholder="Middle Initial">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="font-weight-semibold">Suffix</label>
                                                    <select name="suffix" class="form-control">
                                                        <option value=""></option>
                                                        <option value="Sr.">Sr.</option>
                                                        <option value="Jr.">Jr.</option>
                                                        <option value="II">II</option>
                                                        <option value="III">III</option>
                                                        <option value="IV">IV</option>
                                                        <option value="V">V</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                
                                                <div class="form-group col-md-6">
                                                    <label for="">Contact Number</label>
                                                    <input type="number" class="form-control" name="contactno" placeholder="Contact Number">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Email Address</label>
                                                    <input type="email" class="form-control" name="email" placeholder="Email Address">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4">Sex <small class="text-danger">*</small></label>
                                                    <select class="form-control" name="sex" required>
                                                        <option value=""></option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Address (Region) <small class="text-danger">*</small></label>
                                                    <select class="form-control" name="address_region" id="seladdress-region" onchange="get_provinces_list()" required>
                                                        <option value=""></option>
                                                        <?php foreach ($regions as $regionsRow) {
                                                            ?>
                                                            <option value="<?=$regionsRow['regCode']?>"><?=$regionsRow['regDesc']?></option>
                                                            <?php
                                                        }?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Address (Province) <small class="text-danger">*</small></label>
                                                    <select class="form-control" id="seladdress-provinces" name="address_province" required>
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label class="form-label">Agency/Unit/LGU</label>
                                                    <input type="text" name="agency_name" class="form-control" placeholder="Name of Institution/Agency">
                                                </div>    
                                                <div class="form-group col-md-6">
                                                    <label class="form-label">Position</label>
                                                    <input type="text" name="position" class="form-control" placeholder="Position">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Sector or Affiliation<small class="text-danger">*</small></label>
                                                    <select class="form-control" name="sector" required>
                                                        <option></option>
                                                        <?php foreach ($sectors as $sectorsRow) { ?>
                                                            <option value="<?=$sectorsRow['sectorid']?>"><?=$sectorsRow['sectorname']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Privileges</label>
                                                    <div class="checkbox">
                                                        <input id="checkbox1" type="checkbox" value="PWD" name="privileges[]">
                                                        <label for="checkbox1">PWD</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <input id="checkbox2" type="checkbox" value="Solo Parent" name="privileges[]">
                                                        <label for="checkbox2">Solo Parent</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <input id="checkbox3" type="checkbox" value="Senior Citizen" name="privileges[]">
                                                        <label for="checkbox3">Senior Citizen</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <input id="checkbox4" type="checkbox" value="IP" name="privileges[]">
                                                        <label for="checkbox4">IP</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <button type="submit" class="btn btn-danger custom-class float-right">Register</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="d-none d-md-flex p-h-40 justify-content-between">
                    <span class="text-white">© <?=date('Y')?> <a href="https://region10.dost.gov.ph">DOST 10</a></span>
                </div> -->
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#registration-form-container").hide();
            $("#exists-alert").hide();

        });

        function show_registration_details(){
            $("#registration-form-container").show();
            $("#privacy-notice-container").hide();
            $(window).scrollTop(0);
        }

        function get_provinces_list(){
            var regCode = $("#seladdress-region").val();

            $.get("<?=base_url('handa/get-provinces-list')?>",{
                regCode:regCode
            },function(data){
                $("#seladdress-provinces").html(data);
            });
        }

        $("#registration-event-form").submit(function (e) { 

            registration_process();
            e.preventDefault();
            
        });

        function registration_process(){
            $.post("<?=base_url('handa/reg-process')?>",{
                data:$("#registration-event-form").serializeArray()
            },function(data){
                if (data == "EXISTS") {
                    $("#exists-alert").show();
                    $(window).scrollTop(0);
                }else{
                    window.location.href = '<?=base_url('handa/qr-code/')?>'+data;
                }
            });
        }
    </script>
<?= $this->endSection() ?>
