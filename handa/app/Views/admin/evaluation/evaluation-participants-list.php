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
                            <th>Address</th>
                            <th>Privileges</th>
                            <th>How did you hear about this event?</th>
                            <th class="text-right" data-toggle="tooltip" data-placement="top" title="I spent an acceptable amount of time to complete this training."><small><span hidden>I spent an acceptable amount of time to complete this training. </span><b>(Responsiveness)</b></small></th>
                            <th class="text-right" data-toggle="tooltip" data-placement="top" title="The office accurately informed and followed the training’s requirements and steps."><small><span hidden>The office accurately informed and followed the training’s requirements and steps.</span> <b>(Reliability)</b></small></th>
                            <th class="text-right" data-toggle="tooltip" data-placement="top" title="My training process (including steps) was simple and convenient."><small><span hidden>My training process (including steps) was simple and convenient.</span> <b>(Access and Facilities)</b></small></th>
                            <th class="text-right" data-toggle="tooltip" data-placement="top" title="I easily found information about the training from the office staff or internet."><small><span hidden>I easily found information about the training from the office staff or internet.</span> <b>(Communication)</b></small></th>
                            <th class="text-right" data-toggle="tooltip" data-placement="top" title="I did not pay any fees for this training."><small><span hidden>I did not pay any fees for this training.</span> <b>(Cash Free)</b></small></th>
                            <th class="text-right" data-toggle="tooltip" data-placement="top" title="I am confident this training was secure."><small><span hidden>I am confident this training was secure.</span> <b>(Integrity)</b></small></th>
                            <th class="text-right" data-toggle="tooltip" data-placement="top" title="The office staff was quick to respond to my queries."><small><span hidden>The office staff was quick to respond to my queries.</span> <b>(Assurance)</b></small></th>
                            <th class="text-right" data-toggle="tooltip" data-placement="top" title="I got what I needed from this government office"><small><span hidden>I got what I needed from this government office</span> <b>(Outcome)</b></small></th>
                            <th class="text-right"><small><b>Overall Satisfaction</b></small></th>
                            <th>If you rated 2-Fair or 1-Poor in the OVERALL SATISFACTION.</th>
                            <th>If you rated 5-Excellent in the OVERALL SATISFACTION</th>
                            <th>How likely would you recommend our services to others?</th>
                            <th>Other Requests</th>
                            <th>Interested Technology</th>
                            <th><span hidden>Do you have other questions you were not able to relay during the forum? If so, you can share it here and we'll try to get back to you.</span>Other Questions</small></th>
                            <th>Event</th>
                            <th>Evaluation Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 0; foreach ($evaluation as $evaluationRow) { ?>
                            <tr>
                                <td><?=$counter+=1?></td>
                                <td><a target="_blank" href="<?=base_url('certificates?certnumber=').$evaluationRow['certnumber_hashed']?>"><b><?=$evaluationRow['certnumber']?></b></a></td>
                                <td><?=$evaluationRow['title']?></td>
                                <td><?=$evaluationRow['fullname']?></td>
                                <td><small><?=$evaluationRow['agency_name']?></small></td>
                                <td><small><?=$evaluationRow['email']?></small></td>
                                <td><small><?=$evaluationRow['sex']?></small></td>
                                <td>
                                    <small><?=$evaluationRow['regDesc']." - <br>".$evaluationRow['provDesc']?></small>
                                </td>
                                <td><small><?=$evaluationRow['privileges']?></small></td>
                                <td><small><?=$evaluationRow['sourceinfo']?></small></td>
                                <td class="text-right"><?=$evaluationRow['responsiveness']?></td>
                                <td class="text-right"><?=$evaluationRow['reliability']?></td>
                                <td class="text-right"><?=$evaluationRow['access_and_facilities']?></td>
                                <td class="text-right"><?=$evaluationRow['communication']?></td>
                                <td class="text-right"><?=$evaluationRow['cash']?></td>
                                <td class="text-right"><?=$evaluationRow['integrity']?></td>
                                <td class="text-right"><?=$evaluationRow['assurance']?></td>
                                <td class="text-right"><?=$evaluationRow['outcome']?></td>
                                <td class="text-right"><?=$evaluationRow['overall_satisfaction']?></td>
                                <td><?=$evaluationRow['if_fair_poor']?></td>
                                <td><?=$evaluationRow['if_excellent']?></td>
                                <td><?=$evaluationRow['recommend']?></td>
                                <td><?=$evaluationRow['other_request']?></td>
                                <td><?=$evaluationRow['interest_technology']?></td>
                                <td><?=$evaluationRow['other_questions']?></td>
                                <td><small><?=$evaluationRow['name']?></small></td>
                                <td><?=date("M d, Y h:i A",strtotime($evaluationRow['date_registered'].'+8 hours'))?></td>
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
