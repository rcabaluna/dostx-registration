<?= $this->extend('templates/main-admin') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <div class="card">
        <div class="card-body">
            <h4>Attendance List</h4>
            <div class="align-items-center justify-content-between m-b-30">
                <div class="row">
                <?php if($_SESSION['usertype'] == 'admin'){  ?>
                    <div class="col-md-12">
                        <label>Select forum/event:</label>
                        <select class="form-control" id="selevents" onchange="get_participants_by_event()">
                            <option value="all">All</option>
                            <?php foreach ($events as $eventsRow) { ?>
                            <option value="<?=$eventsRow['shorthand']?>"><?=$eventsRow['name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php
                        }?>
                </div>
            </div>
            <div class="m-t-25">
                <table class="table" id="attendance-table">
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
                            <td><?=$attendanceRow['position']?></td>
                            <td><?=$attendanceRow['sectorname']?></td>
                            <td><small><?=$attendanceRow['name']?></small></td>
                            <td><?=($attendanceRow['privileges']) ? $attendanceRow['privileges'] : '-' ?></td>
                            <td><?=date("M d, Y h:i A",strtotime($attendanceRow['attendance_date'].'+8 hours'))?></td>
                            <td>
                                <button class="btn btn-danger btn-xs" onclick="set_delete_link(<?=$attendanceRow['attendanceid']?>)"><i class="anticon anticon-delete"></i></button>
                            </td>
                        </tr>
                        <?php
                                        }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        <!-- Modal -->
        <div class="modal fade" id="confirm-delete-mdl">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h3>Are you sure you want to <br>delete this attendance data?</h3>
                    <p>This process cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a href="#" id="delete-link-href"><button type="button" class="btn btn-danger">Confirm</button></a>
                </div>
            </div>
        </div>
    </div>
    <div class="notification-toast top-right" id="notification-toast"></div>
</div>

    <?php if(isset($_SESSION['delete'])){ echo '<script>show_notification_delete("attendance");</script>'; } ?>      
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
            ],
            paging: true, scrollCollapse: true, scrollY: '50vh' 
        });

        

        function get_participants_by_event() {
            var event = $("#selevents").val();
            window.location.replace("<?=base_url('attendance?event=')?>"+event);
        }

        function set_delete_link(attendanceid){
            $("#options-mdl").modal("hide");
            $("#confirm-delete-mdl").modal("show");
            $("#delete-link-href").attr("href", "<?=base_url('attendance/delete?attendanceid=')?>"+attendanceid);
        }
    </script>
<?= $this->endSection() ?>
