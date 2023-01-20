<div class="container">
    <?php
    if (in_array('duplicate', $inputWarning)) {
        echo 'Mitarbeiter bereits in der Datenbank vorhanden.<br>';
    }
    if (in_array('empty', $inputWarning)) {
        echo 'Alle Felder müssen ausgefüllt werden.<br>';
    }
    if (in_array('salaryNotFloat', $inputWarning)) {
        echo 'Der Monatslohn muss im Dezimalformat eingegeben werden.<br>';
    }
    ?>
</div>