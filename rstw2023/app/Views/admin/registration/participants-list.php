<?= $this->extend('templates/main-admin') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <div class="card">
        <div class="card-body">
            <h4>Participants List <button class="btn btn-success btn-tone btn-xs float-right" onclick="retrieve_data()">Retrieve Data from Google Form</button></h4>
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
                <table class="table" id="participants-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Registration No.</th>
                            <th>Title</th>
                            <th>Name</th>
                            <th>Contact No</th>
                            <th>Email</th>
                            <th>Sex</th>
                            <th>Agency Name</th>
                            <th>Agency Address</th>
                            <th>Position</th>
                            <th>Event</th>
                            <th>Privileges</th>
                            <th>Date Registered</th>
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
                            <td><?=$participantsRow['agency_name']?></td>
                            <td><?=$participantsRow['agency_address']?></td>
                            <td><?=$participantsRow['position']?></td>
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
                    <h3>
                        Are you sure you want to <br />
                        delete this participant?
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

<?php if(isset($_SESSION['delete'])){ echo '<script>show_notification_delete("participant");</script>'; } ?>             
    <script>
        $(document).ready(function () {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const event = urlParams.get('event');
            $("#selevents").val(event);
            $("#ul-three").addClass("open");
            $("#li-participants").addClass("active");

            retrieve_data();

            
        });


        setInterval(retrieve_data, 5000);

        function retrieve_data(){
                var event = $("#selevents").val();

                if (event != 'all') {
                    $.post("<?=base_url('participants/retrieve-csv-data')?>",{
                        event:event
                    },function(data){
                        console.log(data);
                        
                    });
                }
            }

        function set_delete_link(participantid){
            $("#options-mdl").modal("hide");
            $("#confirm-delete-mdl").modal("show");
            $("#delete-link-href").attr("href", "<?=base_url('participants/delete?participantid=')?>"+participantid);
        }
        $('#participants-table').DataTable({
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
            window.location.replace("<?=base_url('participants?event=')?>"+event);
        }

        let table = $('#participants-table').DataTable();
 
        table.on('click', 'tbody tr', function () {
            let data = table.row(this).data();

            var participantid = $(this).closest("tr").attr('participantid');
            var shorthand = $(this).closest("tr").attr('shorthand');
            
            $("#regnumber-options-mdl").html(data[3]);
            $("#event-title-options-mdl").html(data[10]);
            $("#qr-options-mdl").attr("src", "<?=base_url('uploads/qr/')?>"+data[1]+".png");
            $("#delete-icon-options-mdl").attr("onclick", "set_delete_link("+participantid+")");
            $("#confirm-attendance-options-mdl").attr("onclick","confirm_forum_attendance('"+shorthand+"','"+data[1]+"')");
            $("#options-mdl").modal("show");
        });

        function confirm_forum_attendance(shorthand,regnumber){
            $.post("<?=base_url('attendance/reg-confirm-attendance')?>",{
                event:shorthand,
                regnumber:regnumber
            },function(data){
                if (data == "SUCCESS") {
                    $("#attendance-confirmed-success").show();
                    $("#attendance-confirmed-success").delay(3000).hide(500);
                    $("#options-mdl").modal("hide");
                }else{
                    console.log("EXISTS");
                    $("#attendance-exists").show();
                    $("#attendance-exists").delay(3000).hide(500);
                    $("#options-mdl").modal("hide");
                }
            });
        }

        
    </script>
<?= $this->endSection() ?>
