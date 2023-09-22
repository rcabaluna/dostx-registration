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
                            <th class="text-right">Target Participants</th>
                            <th class="text-right">Buffer</th>
                            <th class="text-right">Pre-Registered Participants</th>
                            <th class="text-right">% <br>(Excluding Buffer)</th>
                            <th class="text-right">Actual Participants</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($parrAttCount as $parrAttCountRow) { ?>
                            <tr>
                                <td><b><?=$parrAttCountRow['name'];?></b></td>
                                <td class="text-right"><?=$parrAttCountRow['targetparticipants'];?></td>
                                <td class="text-right"><?=$parrAttCountRow['buffer'];?></td>
                                <td class="text-right"><a href="<?=base_url('participants?event='.$parrAttCountRow['shorthand']);?>"><?=$parrAttCountRow['participantsno'];?></a></td>
                                <td class="text-right">
                                    <?php if ($parrAttCountRow['targetparticipants'] != '-') {
                                        echo round(($parrAttCountRow['participantsno']/$parrAttCountRow['targetparticipants'])*100,0)."%";
                                    }else{
                                        echo "-";
                                    }?>
                                </td>
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
