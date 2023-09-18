<?= $this->extend('templates/main-admin') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <div class="card">
        <div class="card-body">
            <h4>Attendance List</h4>
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
                <table class="table-responsive hover display row-border" id="attendance-table">
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
                            <th>Attendance Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count=0; foreach ($attendance as $attendanceRow) {
                                            ?>
                        <tr>
                            <td><?=$count+=1?></td>
                            <td><?=$attendanceRow['regnumber']?></td>
                            <td><?=$attendanceRow['title']?></td>
                            <td><?php
                                echo $attendanceRow['lastname'].', '.$attendanceRow['firstname'];
                                echo ($attendanceRow['suffix'] ? ", ".$attendanceRow['suffix'] : '');
                                echo ($attendanceRow['middle_initial'] ? " ".$attendanceRow['middle_initial'] : '');
                                ?>
                            </td>
                            <td><?=$attendanceRow['contactno']?></td>
                            <td><?=$attendanceRow['email']?></td>
                            <td><?=$attendanceRow['sex']?></td>
                            <td><small><?=$attendanceRow['regDesc']." - <br>".$attendanceRow['provDesc']?></small></td>
                            <td><?=$attendanceRow['agency_name']?></td>
                            <td><?=$attendanceRow['sectorname']?></td>
                            <td><small><?=$attendanceRow['event']?></small></td>
                            <td><?=($attendanceRow['privileges']) ? $attendanceRow['privileges'] : '-' ?></td>
                            <td>
                                <div class="avatar avatar-image avatar-square">
                                    <img src="<?=base_url('uploads/qr/').$attendanceRow['regnumber']?>.png" />
                                </div>
                            </td>
                            <td><?=date("M d, Y h:i A",strtotime($attendanceRow['date_registered'].'+8 hours'))?></td>
                            <td>
                                <button class="btn btn-primary btn-xs"><i class="anticon anticon-edit"></i></button>
                                <a href="<?=base_url('attendance/delete?attendanceid='.$attendanceRow['attendanceid'])?>">
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
            $("#li-attendance").addClass("active");
        });

        $('#attendance-table').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5'
            ],paging: true, scrollCollapse: true, scrollY: '50vh' 
        });

        function get_participants_by_event() {
            var event = $("#selevents").val();
            window.location.replace("<?=base_url('/attendance?event=')?>"+event);
        }
    </script>
<?= $this->endSection() ?>
