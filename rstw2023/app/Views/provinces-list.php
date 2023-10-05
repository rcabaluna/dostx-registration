<option value=""></option>
<?php
    foreach ($provinces as $provincesRow) {
        ?>
        <option value="<?=$provincesRow['provCode']?>"><?=$provincesRow['provDesc']?></option>
        <?php
    }
?>