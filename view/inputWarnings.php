<div class="container">
    <?php
    if (in_array('duplicate', $inputWarning)) {
        if ($area === 'employee') {
            echo 'Mitarbeiter ' . $firstName . ' ' . $lastName . ' bereits in der Datenbank vorhanden.<br>';
        } elseif ($area === 'department') {
            echo 'Eine Abteilung mit der Bezeichnung ' . $departmentName . ' ist bereits in der Datenbank vorhanden.<br>';
        } else {
            $view = 'home';
        }
    }

    if (in_array('empty', $inputWarning)) {
        echo 'Alle Felder müssen ausgefüllt werden.<br>';
    }

    if (in_array('salaryNotFloat', $inputWarning)) {
        echo 'Der Monatslohn muss im Dezimalformat eingegeben werden.<br>';
    }
    ?>
</div>