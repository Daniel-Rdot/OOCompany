<div class="container">
    <?php
    if ($inputWarning === 'duplicate') {
        echo 'Mitarbeiter bereits in der Datenbank vorhanden.<br>';
    }
    if ($inputWarning === 'empty') {
        echo 'Alle Felder müssen ausgefüllt werden.<br>';
    }
    if ($inputWarning === 'salaryNotFloat') {
        echo 'Der Monatslohn muss im Dezimalformat eingegeben werden.';
    }
    ?>
</div>