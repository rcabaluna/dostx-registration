<div class="col">
    <p class="text-dark">6th Regional Health Research Conference - Northern Mindanao<br><span><b>Bukidnon State University</b><br><b>October 10-12, 2023</b></span></p>
    <hr>
    <ul class="list-unstyled m-t-10">
        <li class="row">
            <p class="text-dark col-sm-4 col-4 font-weight-semibold text-dark">
                <span>Reg. No: </span> 
            </p>
            <p class="text-dark col font-weight-semibold"> <?=$regnumber?></p>
        </li>
        <li class="row">
            <p class=" text-dark col-sm-4 col-4 font-weight-semibold text-dark">
                <span>Name: </span> 
            </p>
            <p class="text-dark col font-weight-semibold">
                <b><?php
                    echo $title.' ';
                    echo $firstname;
                    echo ($middle_initial ? ' '.$middle_initial.' ' : ' ');
                    echo $lastname;
                    echo ($suffix ? ", ".$suffix : '');
                ?></b>
            </p>
        </li>
        <li class="row">
            <p class="text-dark col-sm-4 col-4 font-weight-semibold text-dark">
                <span>Sex: </span> 
            </p>
            <p class="text-dark col font-weight-semibold"> <?=$sex?></p>
        </li>
        <li class="row">
            <p class="text-dark col-sm-4 col-4 font-weight-semibold text-dark">
                <span>Address: </span> 
            </p>
            <p class="text-dark col font-weight-semibold"> <?=$regDesc." - ".$provDesc?></p>
        </li>
        <li class="row">
            <p class="text-dark col-sm-4 col-4 font-weight-semibold text-dark">
                <span>Agency: </span> 
            </p>
            <p class="text-dark col font-weight-semibold"> <?=$agency_name?></p>
        </li>
        <li class="row">
            <p class="text-dark col-sm-4 col-4 font-weight-semibold text-dark">
                <span>Position: </span> 
            </p>
            <p class="text-dark col font-weight-semibold"> <?=$position?></p>
        </li>
        <li class="row">
            <p class="text-dark col-sm-4 col-4 font-weight-semibold text-dark">
                <span>Sector: </span> 
            </p>
            <p class="text-dark col font-weight-semibold"> <?=$sectorname?></p>
        </li>
        <li class="row">
            <p class="text-dark col-sm-4 col-4 font-weight-semibold text-dark">
                <span>Event(s): </span> 
            </p>
            <p class="text-dark col font-weight-semibold">
                <?php
                    $event = explode(", ",$event);

                    foreach ($event as $eventRow) {
                        if ($eventRow == "Day 1") {
                            echo "<b>Day 1</b> - Opening Ceremony and Student Category Competitions<br>";
                        }elseif($eventRow == "Day 2"){
                            echo "<b>Day 2</b> - Plenary Session and Professional Category Competitions<br>";
                        }elseif($eventRow == "Day 3"){
                            echo "<b>Day 3</b> - Closing and Awarding Ceremonies<br>";
                        }
                    }
                ?>
            </p>
        </li>
    </ul>
</div>