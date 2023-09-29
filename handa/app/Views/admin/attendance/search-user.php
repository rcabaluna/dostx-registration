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
                    <h4>Recent Attendance</h4>
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
                                <?php $count=0; foreach ($participants as $participantsRow) {
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
                                    <td><?=date("M d, Y h:i A",strtotime($participantsRow['date_registeredx'].'+8 hours'))?></td>
                                    <!-- <td>
                                                        <button type="button" class="btn btn-danger btn-rounded btn-tone btn-xs" onclick="set_delete_link(<?=$participantsRow['participantid']; ?>)" data-toggle="modal" data-target="#exampleModal">
                                                            <i class="anticon anticon-delete"></i>
                                                        </button>
                                                </td> -->
                                </tr>
                                <?php
                                                            }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


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
        paging: false, scrollCollapse: true, scrollY: '50vh' 
    });

</script>
<?= $this->endSection() ?>