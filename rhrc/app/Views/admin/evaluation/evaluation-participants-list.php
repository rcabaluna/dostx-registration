<?= $this->extend('templates/main-admin') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <div class="card">
        <div class="card-body">
            <h4>Evaluation - Participants List</h4>
            <div class="align-items-center justify-content-between m-b-30">
                <div class="row">
                <?php if($_SESSION['usertype'] == 'admin'){  ?>
                    <div class="col-md-12">
                        <label>Select forum/event:</label>
                        <select class="form-control" id="selevents" onchange="get_participants_by_event()">
                            <option value="all">All</option>
                            <option value="day1">Day 1</option>
                            <option value="day2">Day 2</option>
                            <option value="day3">Day 3</option>
                        </select>
                    </div>
                    <?php
                        }?>
                </div>
            </div>
            <div class="m-t-25">
                <table class="table table-responsive table-condensed table-hover" id="participants-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Cert Number</th>
                            <th>Title</th>
                            <th>Name</th>
                            <th>Affiliation</th>
                            <th>Email Address</th>
                            <th>Gender</th>
                            <th>Address (Region)</th>
                            <th>Address (Province)</th>
                            <th>Privileges</th>
                            <th>How did you hear about this event?</th>
                            <th>Event</th>
                            <th>Do you think holding this activity is necessary?</th>
                            <th>Is the purpose of the activity clear to you?</th>
                            <th>Do you think the objective of the activity was achieved?</th>
                            <th>OVERALL MANAGEMENT</th>
                            <th>PLATFORM</th>
                            <th>TRAINER/RESOURCE SPEAKER</th>
                            <th>SECRETARIAT/FACILITATOR</th>
                            <th>PROGRAM</th>
                            <th>TIME ALLOCATION</th>
                            <th>What have you learned from the activity?</th>
                            <th>What improvement can you suggest?</th>
                            <th>Date Evaluated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 0; foreach ($evaluation as $evaluationRow) { ?>
                            <tr>
                                <td><?=$counter+=1?></td>
                                <td><a target="_blank" href="<?=base_url('certificates/cp?certnumber=').$evaluationRow['certnumber_hashed']?>"><b><?=$evaluationRow['certnumber']?></b></a></td>
                                <td><?=$evaluationRow['title']?></td>
                                <td><?=$evaluationRow['fullname']?></td>
                                <td><small><?=$evaluationRow['agency_name']?></small></td>
                                <td><small><?=$evaluationRow['email']?></small></td>
                                <td><small><?=$evaluationRow['sex']?></small></td>
                                <td><small><?=$evaluationRow['regDesc']?></small></td>
                                <td><small><?=$evaluationRow['provDesc']?></small></td>
                                <td><small><?=$evaluationRow['privileges']?></small></td>
                                <td><small><?=$evaluationRow['sourceinfo']?></small></td>
                                <td><small><?=$evaluationRow['event']?></small></td>
                                <td class="text-right"><?=($evaluationRow['q10']) ? 'Yes' : 'No';?></td>
                                <td class="text-right"><?=($evaluationRow['q11']) ? 'Yes' : 'No';?></td>
                                <td class="text-right"><?=($evaluationRow['q12']) ? 'Yes' : 'No';?></td>
                                <td class="text-right"><?=$evaluationRow['q13a']?></td>
                                <td class="text-right"><?=$evaluationRow['q13b']?></td>
                                <td class="text-right"><?=$evaluationRow['q13c']?></td>
                                <td class="text-right"><?=$evaluationRow['q13d']?></td>
                                <td class="text-right"><?=$evaluationRow['q13e']?></td>
                                <td class="text-right"><?=$evaluationRow['q13f']?></td>
                                <td><?=$evaluationRow['learnings']?></td>
                                <td><?=$evaluationRow['suggestions']?></td>
                                <td><?=date("M d, Y h:i A",strtotime($evaluationRow['date_evaluated'].'+8 hours'))?></td>
                                <td><button onclick="set_delete_link(<?=$evaluationRow['evaluationid']?>)" class="btn btn-danger btn-tone btn-xs">Delete</button></td>
                            </tr>
                        <?php }?>
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
                    <h3>
                        Are you sure you want to <br />
                        delete this evaluation data?
                    </h3>
                    <p>This process cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a href="#" id="delete-link-href"><button type="button" class="btn btn-danger">Confirm</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="options-mdl">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Participant's Information</h5>
                    <button type="button" class="btn btn-danger btn-tone btn-xs" id="delete-icon-options-mdl"><i class="anticon anticon-delete"></i></button>
                </div>
                <div class="modal-body text-center">
                    <h5 id="event-title-options-mdl"></h5>
                    <h4 class="m-t-10 mb-0" id="regnumber-options-mdl"></h4>
                    <div class="mb-3">
                        <img id="qr-options-mdl" class="w-100" />
                    </div>
                    <!-- <div class="m-t-20">
                        <button type="button" class="btn btn-warning" id="confirm-attendance-options-mdl">Confirm Attendance</button><br>
                        <button type="button" class="mt-3 btn btn-link btn-xs">Confirm to another Forum</button>

                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="notification-toast top-right" id="notification-toast"></div>
</div>

    <?php if(isset($_SESSION['delete'])){ echo '<script>show_notification_delete("evaluation");</script>'; } ?>
    <script>
        $(document).ready(function () {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const event = urlParams.get('event');
            $("#selevents").val(event);
            $("#ul-six").addClass("open");
            $("#li-evaluation-participants").addClass("active");
        });

        function set_delete_link(evaluationid){
            $("#options-mdl").modal("hide");
            $("#confirm-delete-mdl").modal("show");
            $("#delete-link-href").attr("href", "<?=base_url('evaluation/delete?evaluationid=')?>"+evaluationid);
        }


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
            window.location.replace("<?=base_url('evaluation/participants?event=')?>"+event);
        }
    </script>
<?= $this->endSection() ?>
