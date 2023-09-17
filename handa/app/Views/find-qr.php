<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<?php $uri = service('uri');
    $userid = $uri->getSegment(3); ?>

<div class="container d-flex h-100">
    <div class="row align-items-center w-100" style="margin-left: 0px;">
        <div class="col-md-12 col-lg-12 m-h-auto">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between m-b-30">
                        <div class="row">
                            <div class="col-12">
                                <img class="img-fluid" src="<?=base_url('assets/images/logo/handa-logo-black.png')?>" />
                            </div>
                            <div class="mt-3 col-12" class>
                                <p class="text-dark">Fill out the form below to check your QR Code:</p>
                                <div class="alert alert-danger" id="empty-alert">QR Code not found. Please check and try again.</div>
                            </div>
                            <div class="col-md-12" id="search-form">
                                <form id="search-form">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <div class="form-group col-md-12">
                                                <label class="font-weight-semibold">Registration Number </label>
                                                <input type="text" class="form-control" name="regnumber" placeholder="Registration Number" />
                                            </div>
                                            <p>OR</p>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label class="font-weight-semibold">Last Name </label>
                                            <input type="text" class="form-control" name="lastname" placeholder="Last Name" />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="font-weight-semibold">First Name </label>
                                            <input type="text" class="form-control" name="firstname" placeholder="First Name" />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="font-weight-semibold">Middle Initial </label>
                                            <input type="text" class="form-control" name="middle_initial" placeholder="Middle Initial" />
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
                                            <input type="number" class="form-control" name="contactno" placeholder="Contact Number" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Email Address</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email Address" />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-danger custom-class float-right">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row" id="qr-code-container">
                            <div class="col-md-12">
                                <img class="img-fluid mx-auto d-block" src="<?=base_url('uploads/qr/')?>.png" />
                                <p class="text-center font-weight-semibold text-dark"></p>
                            </div>
                            <div class="col-md-12 mt-3 text-center">
                                <a download=".png" href="<?=base_url('uploads/qr/')?>.png" target="_blank">
                                    <button class="btn btn-danger custom-class">Download</button>
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
        $("#qr-code-container").hide();
        $("#empty-alert").hide();

        $("#search-form").submit(function (e) {
            search_profile();
            e.preventDefault();
        });
    });



    function search_profile() {
        $.post(
            "<?=base_url('handa/find-qr-process')?>",
            {
                data: $("#search-form").serializeArray(),
            },
            function (data) {
                if (data == "EMPTY") {
                    $("#empty-alert").show();
                    $(window).scrollTop(0);
                } else {
                    console.log(data);
                }
            }
        );
    }
</script>
<?= $this->endSection() ?>
