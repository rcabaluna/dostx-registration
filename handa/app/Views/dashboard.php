<?= $this->extend('templates/main-admin') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <div class="card">
        <div class="card-body">
            <h4>Dashboard</h4>
            <div class="m-t-25">
                <table class="table" id="no-participants-table">
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>No. of Pre-Registered Participants</th>
                            <th>No. of Actual Participants</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($parrAttCount as $parrAttCountRow) { ?>
                            <tr>
                                <td><?=$parrAttCountRow['name'];?></td>
                                <td class="text-right"><a href="<?=base_url('participants?event='.$parrAttCountRow['shorthand']);?>"><?=$parrAttCountRow['participantsno'];?></a></td>
                                <td class="text-right"><a href="<?=base_url('attendance?event='.$parrAttCountRow['shorthand']);?>"><?=$parrAttCountRow['attendanceno'];?></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
                
    <script>
        $(document).ready(function () {
            $("#ul-four a").addClass("activex");
        });

        $('#no-participants-table').DataTable({
            ordering: false,
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5'
            ],
            paging: true, scrollCollapse: true, scrollY: '50vh' 
        });
    </script>
<?= $this->endSection() ?>
