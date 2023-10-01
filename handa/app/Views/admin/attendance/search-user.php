<?= $this->extend('templates/main-walk-in') ?>
<?= $this->section('content') ?>
<style>
    p {
        color: #2a2a2a !important;
    }
</style>
<div class="container-fluid h-100 px-0">
    <div class="row align-items-center w-100" style="margin-left: 0px;">
        <div class="col-md-12 col-lg-12 m-h-auto">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="align-items-center justify-content-between m-b-1">
                        <div class="row mb-3">
                            <div class="col-12"><img class="img-fluid" src="<?=base_url("assets/images/logo/walk-in-reg-header.png");?>"></div>
                        </div>
                    </div>
                    <hr />
                    <h4>Attendance (Search Participant) <button class="btn btn-tone btn-danger btn-xs" data-toggle="modal" data-target="#search-user-mdl ">Search</button></h4>
                    <div class="m-t-25">
                        <table class="table table-hover table-condensed" id="participants-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Registration No.</th>
                                    <th>Title</th>
                                    <th>Name</th>
                                    <th>Contact No</th>
                                    <th>Email</th>
                                    <th>Sex</th>
                                    <th>Address</th>
                                    <th>Agency Name</th>
                                    <th>Position</th>
                                    <th>Sector/Affiliation</th>
                                    <th>Event</th>
                                    <th>Privileges</th>
                                    <th>Participants Date</th>
                                    <!-- <th>Actions</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($participants) {
                                 $count=0; foreach ($participants as $participantsRow) {
                                                        ?>
                                <tr participantid="<?=$participantsRow['participantid']?>" shorthand="<?=$participantsRow['shorthand']?>">
                                    <td><?=$count+=1?></td>
                                    <td><?=$participantsRow['regnumber']?></td>
                                    <td><?=$participantsRow['title']?></td>
                                    <td>
                                        <?php
                                            echo $participantsRow['lastname'].', '.$participantsRow['firstname'];
                                            echo ($participantsRow['suffix'] ? ", ".$participantsRow['suffix'] : '');
                                            echo ($participantsRow['middle_initial'] ? " ".$participantsRow['middle_initial'] : '');
                                            ?>
                                    </td>
                                    <td><?=$participantsRow['contactno']?></td>
                                    <td><?=$participantsRow['email']?></td>
                                    <td><?=$participantsRow['sex']?></td>
                                    <td>
                                        <small><?=$participantsRow['regDesc']." - <br>".$participantsRow['provDesc']?></small>
                                    </td>
                                    <td><?=$participantsRow['agency_name']?></td>
                                    <td><?=$participantsRow['position']?></td>
                                    <td><?=$participantsRow['sectorname']?></td>
                                    <td>
                                        <small><?=$participantsRow['name']?></small>
                                    </td>
                                    <td><?=($participantsRow['privileges']) ? $participantsRow['privileges'] : '-' ?></td>
                                    <td><?=date("M d, Y h:i A",strtotime($participantsRow['date_registered'].'+8 hours'))?></td>
                                    <!-- <td>
                                                        <button type="button" class="btn btn-danger btn-rounded btn-tone btn-xs" onclick="set_delete_link(<?=$participantsRow['participantid']; ?>)" data-toggle="modal" data-target="#exampleModal">
                                                            <i class="anticon anticon-delete"></i>
                                                        </button>
                                                </td> -->
                                </tr>
                                <?php }  
                                }  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="notification-toast top-right" id="notification-toast"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="search-user-mdl">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search Participant</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <form>
                <div class="modal-body">
                    
                        <div class="form-group">
                            <label for="formGroupExampleInput">Last Name</label>
                            <input type="text" name="lastname" class="form-control" id="formGroupExampleInput" placeholder="Enter Last Name">
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">First Name</label>
                            <input type="text" name="firstname" class="form-control" id="formGroupExampleInput2" placeholder="Enter First Name">
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Search</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="options-mdl">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Attendance</h5>
                </div>
                <form method="POST" id="confirm-att-by-search">
                    <div class="modal-body text-center">
                        <h5 id="event-title-options-mdl"></h5>
                        <h4 class="m-t-10 mb-0" id="regnumber-options-mdl"></h4>
                        <div class="mb-3">
                            <img id="qr-options-mdl" class="w-100" />
                        </div>
                        <input type="hidden" id="event" name="event">
                        <input type="hidden" id="regnumber" name="regnumber">

                        <div class="m-t-20">
                            <button type="submit" class="btn btn-danger" id="confirm-attendance-options-mdl">Confirm Attendance</button><br>
                            <button type="button" class="mt-3 btn btn-link btn-xs">Confirm to another Forum</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="notification-toast top-right" id="notification-toast"></div>
</div>
<?php if(isset($_SESSION['exists'])){ echo '<script>show_notification_exists("attendance");</script>'; } ?>    
<?php if(isset($_SESSION['confirmed'])){ echo '<script>show_notification_confirmed("attendance");</script>'; } ?>    
<script type="text/javascript">

    $(document).ready(function () {
        $("#alert-success").hide();
        $("#alert-exists").hide();
        $("#alert-invalid").hide();
        $("#ul-one").addClass("open");
        $("#li-attendance-search-user").addClass("active");
    });

    $('#participants-table').DataTable({
        responsive: true,
        paging: true, scrollCollapse: true, scrollY: '45vh' 
    });

    let table = $('#participants-table').DataTable();
 
        table.on('click', 'tbody tr', function () {
            let data = table.row(this).data();

            var participantid = $(this).closest("tr").attr('participantid');
            var shorthand = $(this).closest("tr").attr('shorthand');
            
            $("#regnumber-options-mdl").html(data[3]);
            $("#event-title-options-mdl").html(data[11]);
            $("#qr-options-mdl").attr("src", "<?=base_url('uploads/qr/')?>"+data[1]+".png");
            $("#regnumber").val(data[1]);
            $("#event").val(shorthand);
            $("#confirm-att-by-search").attr("action","<?=base_url('attendance/confirm-att-search')?>");
            $("#options-mdl").modal("show");
        });

</script>
<?= $this->endSection() ?>