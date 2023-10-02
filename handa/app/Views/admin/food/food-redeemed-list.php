<?= $this->extend('templates/main-admin') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <div class="card">
        <div class="card-body">
            <h4>Food Redeemed List</h4>
            <div class="align-items-center justify-content-between m-b-30">
                <div class="row">
                <?php if($_SESSION['usertype'] == 'admin'){  ?>
                    <div class="col-md-12">
                        <label>Select forum/event:</label>
                        <select class="form-control" id="selevents" onchange="get_participants_by_event()">
                            <option value="all">All</option>
                            <option value="AMSnacks">AM Snacks</option>
                            <option value="Lunch">Lunch</option>
                            <option value="PMSnacks">PM Snacks</option>
                            <option value="Dinner">Dinner</option>
                           
                        </select>
                    </div>
                    <?php
                        }?>
                </div>
            </div>
            <div class="m-t-25">
                <table class="table" id="redeem-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Registration No.</th>
                            <th>Title</th>
                            <th>Name</th>
                            <th>Contact No</th>
                            <th>Email</th>
                            <th>Agency Name</th>
                            <th>Privileges</th>
                            <th>Date Redeemed</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count=0; foreach ($redeem as $redeemRow) {
                                            ?>
                        <tr>
                            <td><?=$count+=1?></td>
                            <td><?=$redeemRow['regnumber']?></td>
                            <td><?=$redeemRow['title']?></td>
                            <td><?php
                                echo $redeemRow['lastname'].', '.$redeemRow['firstname'];
                                echo ($redeemRow['suffix'] ? ", ".$redeemRow['suffix'] : '');
                                echo ($redeemRow['middle_initial'] ? " ".$redeemRow['middle_initial'] : '');
                                ?>
                            </td>
                            <td><?=$redeemRow['contactno']?></td>
                            <td><?=$redeemRow['email']?></td>
                            <td><?=$redeemRow['sex']?></td>
                            <td><?=$redeemRow['agency_name']?></td>
                            <td><?=($redeemRow['privileges']) ? $redeemRow['privileges'] : '-' ?></td>
                            <td><?=date("M d, Y h:i A",strtotime($redeemRow['date_registered'].'+8 hours'))?></td>
                            <td>
                                <button class="btn btn-danger btn-xs" onclick="set_delete_link(<?=$redeemRow['foodredeemid']?>)"><i class="anticon anticon-delete"></i></button>
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
                    <h3>Are you sure you want to <br>delete this data?</h3>
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

    <?php if(isset($_SESSION['delete'])){ echo '<script>show_notification_delete("food redeem");</script>'; } ?>      
    <script>
        $(document).ready(function () {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const event = urlParams.get('type');
            $("#selevents").val(event);
            $("#ul-one").addClass("open");
            $("#li-redeem").addClass("active");
        });

        $('#redeem-table').DataTable({
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
            window.location.replace("<?=base_url('food-redeem?type=')?>"+event);
        }

        function set_delete_link(redeemid){
            $("#options-mdl").modal("hide");
            $("#confirm-delete-mdl").modal("show");
            $("#delete-link-href").attr("href", "<?=base_url('food/delete?foodredeemid=')?>"+redeemid);
        }
    </script>
<?= $this->endSection() ?>
