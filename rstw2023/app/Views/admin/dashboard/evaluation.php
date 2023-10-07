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
                            <th class="text-right">No. of Respondents</th>
                            <th class="text-right"><small>I spent an acceptable amount of time to complete this training. <b>(Responsiveness)</b></small></th>
                            <th class="text-right"><small>The office accurately informed and followed the training’s requirements and steps. <b>(Reliability)</b></small></th>
                            <th class="text-right"><small>My training process (including steps) was simple and convenient. <b>(Access and Facilities)</b></small></th>
                            <th class="text-right"><small>I easily found information about the training from the office staff or internet. <b>(Communication)</b></small></th>
                            <th class="text-right"><small>I did not pay any fees for this training. <b>(Cash Free)</b></small></th>
                            <th class="text-right"><small>I am confident this training was secure. <b>(Integrity)</b></small></th>
                            <th class="text-right"><small>The office staff was quick to respond to my queries. <b>(Assurance)</b></small></th>
                            <th class="text-right"><small>I got what I needed from this government office <b>(Outcome)</b></small></th>
                            <th class="text-right"><small><b>Overall Satisfaction</b></small></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($evalCount as $evalCountRow) { ?>
                            <tr>
                                <td><a href="<?=base_url("evaluation/participants?event=all")?>"><b><?=$evalCountRow['name']?></b></a></td>
                                <td class="text-right"><?=$evalCountRow['noofrespondents']?></td>
                                <td class="text-right"><?=$evalCountRow['responsiveness']?></td>
                                <td class="text-right"><?=$evalCountRow['reliability']?></td>
                                <td class="text-right"><?=$evalCountRow['access_and_facilities']?></td>
                                <td class="text-right"><?=$evalCountRow['communication']?></td>
                                <td class="text-right"><?=$evalCountRow['cash']?></td>
                                <td class="text-right"><?=$evalCountRow['integrity']?></td>
                                <td class="text-right"><?=$evalCountRow['assurance']?></td>
                                <td class="text-right"><?=$evalCountRow['outcome']?></td>
                                <td class="text-right"><?=$evalCountRow['overall_satisfaction']?></td>
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
