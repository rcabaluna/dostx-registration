<?= $this->extend('templates/main-walk-in') ?>
<?= $this->section('content') ?>
<?php $uri = service('uri'); ?>
<style>
    p{
        color: #2a2a2a !important;
    }
</style>
<div class="container-fluid d-flex h-100 px-0">
    <div class="row align-items-center w-100" style="margin-left: 0px;">
        <div class="col-md-12 col-lg-12 m-h-auto">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="align-items-center justify-content-between m-b-1">
                        <div class="row mb-3">
                            <div class="col-12">
                                <img class="img-fluid" src="<?=base_url("assets/images/logo/walk-in-reg-header.png");?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="event-title">
                                    <h1>
                                        <b>Title:</b>
                                        <?=$eventx['name'];?>
                                    </h1>
                                    <h5>
                                        <b>Venue:</b>
                                        <?=$eventx['venue'];?>
                                    </h5>
                                    <h5>
                                        <b>Date and Time:</b>
                                        <?=$eventx['datetime'];?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id="registration-form-container">
                        <div class="alert alert-danger" id="exists-alert"> You are already registered to this event. 
                    </div>
                    <h4>Registration Details</h4>
                        <form id="registration-event-form">
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label class="font-weight-semibold">Title (e.g. Dr., Mr., Mrs.) <small class="text-danger">*</small></label>
                                    <input type="hidden" name="event" value="<?=$uri->getSegment(3)?>">
                                    <select name="title" class="form-control form-control-lg" required>
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
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold">Last Name <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control form-control-lg" name="lastname" placeholder="Last Name" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold">First Name  <small class="text-danger">*</small></label>
                                    <input type="text" class="form-control form-control-lg" name="firstname" placeholder="First Name" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold">Middle Initial </label>
                                    <input type="text" class="form-control form-control-lg" name="middle_initial" placeholder="Middle Initial">
                                </div>
                                <div class="form-group col-md-1">
                                    <label class="font-weight-semibold">Suffix</label>
                                    <select name="suffix" class="form-control form-control-lg">
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
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Sex <small class="text-danger">*</small></label>
                                    <select class="form-control form-control-lg" name="sex" required>
                                        <option value=""></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Prefer not to say">Prefer not to say</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Contact Number</label>
                                    <input type="number" maxlength="11" class="form-control form-control-lg" name="contactno" placeholder="Contact Number">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Email Address</label>
                                    <input type="email" class="form-control form-control-lg" name="email" placeholder="Email Address">
                                </div>
                            </div>
                            <div class="form-row">
                                
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Address (Region) <small class="text-danger">*</small></label>
                                    <select class="form-control form-control-lg" name="address_region" id="seladdress-region" onchange="get_provinces_list()" required>
                                        <option value=""></option>
                                        <?php foreach ($regions as $regionsRow) {
                                            ?>
                                            <option value="<?=$regionsRow['regCode']?>"><?=$regionsRow['regDesc']?></option>
                                            <?php
                                        }?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Address (Province) <small class="text-danger">*</small></label>
                                    <select class="form-control form-control-lg" id="seladdress-provinces" name="address_province" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Sector or Affiliation<small class="text-danger">*</small></label>
                                    <select class="form-control form-control-lg" name="sector" required>
                                        <option></option>
                                        <?php foreach ($sectors as $sectorsRow) { ?>
                                            <option value="<?=$sectorsRow['sectorid']?>"><?=$sectorsRow['sectorname']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="form-label">Name of Institution/Agency</label>
                                    <input type="text" name="agency_name" class="form-control form-control-lg" placeholder="Name of Institution/Agency">
                                </div>    
                                <div class="form-group col-md-4">
                                    <label class="form-label">Position</label>
                                    <input type="text" name="position" class="form-control form-control-lg" placeholder="Position">
                                </div>
                                <div class="form-group col-md-4">
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
                                <div class="form-group col-md-12 mb-0">
                                    <button type="submit" class="btn btn-danger custom-class float-right mb-2">Register</button>
                                    <button type="reset" id="reset-btn" class="btn btn-danger btn-tone custom-class">Clear</button>
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

    <script>
        $(document).ready(function () {
            $("#exists-alert").hide();
        });

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

        $("#registration-event-form").submit(function (e) { 

            registration_process();
            e.preventDefault();
            
        });

        function registration_process(){
            $.post("<?=base_url('w-reg-process')?>",{
                data:$("#registration-event-form").serializeArray()
            },function(data){
                if (data == "EXISTS") {
                    $("#exists-alert").show();
                    $(window).scrollTop(0);
                }else{
                    window.location.href = '<?=base_url('qr-code/')?>'+data;
                }
            });
        }
    </script>
<?= $this->endSection() ?>
