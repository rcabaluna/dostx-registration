<div class="col">
    <p class="text-dark"><?=$name?><br><span><b><?=$venue?></b><br><b><?=$datetime?></b></span></p>
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
    </ul>
</div>