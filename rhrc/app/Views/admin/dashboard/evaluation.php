<?= $this->extend('templates/main-admin') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <div class="card">
        <div class="card-body">
            <h4>HANDA Pilipinas 2023 - Forums Training Evaluation Summary</h4>
            <div class="m-t-25">
                <table class="table table-hover" id="no-participants-table">
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>No. of Respondents</th>
                            <th>OVERALL MANAGEMENT</th>
                            <th>PLATFORM</th>
                            <th>TRAINER/RESOURCE SPEAKER</th>
                            <th>SECRETARIAT/FACILITATOR</th>
                            <th>PROGRAM</th>
                            <th>TIME ALLOCATION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($evalCount as $evalCountRow) { ?>
                            <tr>
                                <td><a href="<?=base_url("evaluation/participants?event=".$evalCountRow['event'])?>"><b><?=$evalCountRow['name']?></b></a></td>
                                <td class="text-right"><?=$evalCountRow['noofrespondents']?></td>
                                <td class="text-right"><?=$evalCountRow['q13a']?></td>
                                <td class="text-right"><?=$evalCountRow['q13b']?></td>
                                <td class="text-right"><?=$evalCountRow['q13c']?></td>
                                <td class="text-right"><?=$evalCountRow['q13d']?></td>
                                <td class="text-right"><?=$evalCountRow['q13e']?></td>
                                <td class="text-right"><?=$evalCountRow['q13f']?></td>
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
            $("#ul-four").addClass("open");
            $("#li-evaluation-stats").addClass("active");
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
