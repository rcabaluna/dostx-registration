<?= $this->extend('templates/main-admin') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <div class="card">
        <div class="card-body">
            <h4>Participants List</h4>
            <div class="d-flex align-items-center justify-content-between m-b-30">
                            <div class="row">
                                <?php if(isset($_SESSION['delete'])){
                                                    ?>
                                <div class="col-md-12">
                                    <div class="alert alert-info">
                                        The participant has been deleted successfully!
                                    </div>
                                </div>
                                <?php
                                }?>
                                <div class="col-md-12">
                                    <label>Select forum/event:</label>
                                    <select class="form-control" id="selevents" onchange="get_participants_by_event()">
                                        <option value="all">All</option>
                                        <?php foreach ($events as $eventsRow) { ?>
                                        <option value="<?=$eventsRow['shorthand']?>"><?=$eventsRow['name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mt-3 col-12">
                                    
                                </div>
                            </div>
                        </div>
            <div class="m-t-25">
                <table class="table table-condensed table-responsive" id="participants-table">
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
                            <th>Sector/Affiliation</th>
                            <th>Event</th>
                            <th>Privileges</th>
                            <th>QR Code</th>
                            <th>Participants Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count=0; foreach ($participants as $participantsRow) {
                                            ?>
                        <tr>
                            <td><?=$count+=1?></td>
                            <td><?=$participantsRow['regnumber']?></td>
                            <td><?=$participantsRow['title']?></td>
                            <td><?php
                                echo $participantsRow['lastname'].', '.$participantsRow['firstname'];
                                echo ($participantsRow['suffix'] ? ", ".$participantsRow['suffix'] : '');
                                echo ($participantsRow['middle_initial'] ? " ".$participantsRow['middle_initial'] : '');
                                ?>
                            </td>
                            <td><?=$participantsRow['contactno']?></td>
                            <td><?=$participantsRow['email']?></td>
                            <td><?=$participantsRow['sex']?></td>
                            <td><small><?=$participantsRow['regDesc']." - <br>".$participantsRow['provDesc']?></small></td>
                            <td><?=$participantsRow['agency_name']?></td>
                            <td><?=$participantsRow['sectorname']?></td>
                            <td><small><?=$participantsRow['name']?></small></td>
                            <td><?=($participantsRow['privileges']) ? $participantsRow['privileges'] : '-' ?></td>
                            <td>
                                <div class="avatar avatar-image avatar-square">
                                    <img src="<?=base_url('uploads/qr/').$participantsRow['regnumber']?>.png" />
                                </div>
                            </td>
                            <td><?=date("M d, Y h:i A",strtotime($participantsRow['date_registered']))?></td>
                            <td>
                                <button class="btn btn-primary btn-xs"><i class="anticon anticon-edit"></i></button>
                                <a href="<?=base_url('handa/participants/delete?participantid='.$participantsRow['participantid'])?>">
                                    <button class="btn btn-danger btn-xs"><i class="anticon anticon-delete"></i></button>
                                </a>
                            </td>
                        </tr>
                        <?php
                                        }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
                
    <script>
        $(document).ready(function () {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const event = urlParams.get('event');
            $("#selevents").val(event);
            $("#ul-one").addClass("open");
            $("#li-participants").addClass("active");

        });
        $('#participants-table').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5'
            ]
        });

        function get_participants_by_event() {
            var event = $("#selevents").val();
            window.location.replace("<?=base_url('/handa/participants?event=')?>"+event);
        }
    </script>
<?= $this->endSection() ?>
