<div class="container">
    <?php
    echo '<table class="highlight striped"><thead>';
    echo '<tr><th>ID</th><th>Nachname</th><th>Vorname</th><th>Geschlecht</th><th>Monatslohn</th><th>Abteilung</th></tr>';
    echo '</thead><tbody>';
    $readArr = Employee::getAll();
    for ($i = 0; $i < count($readArr); $i++) {
        $currentId = $readArr[$i]->getId();
        echo '<tr><td>' . $currentId . '</td><td>' . $readArr[$i]->getLastName() .
            '</td><td>' . $readArr[$i]->getFirstName() .
            '</td><td>' . $readArr[$i]->getSex() .
            '</td><td>' . $readArr[$i]->getSalary() .
            '</td><td>' . Department::getById($readArr[$i]->getDepartmentId())->getDptName() .
            '</td><form action="index.php" method="post"><td><button class="btn waves-effect waves-light" name="action" value="showUpdate' .
            $currentId . '" type="submit" id="' . $currentId . '">Ändern</button></td>' .
            '<td><button class="btn waves-effect waves-light" name="action" value="deleteEmployee' .
            $currentId . '" type="submit" id="' . $currentId . '">Löschen</button></td></form>' .
            '</tr>';
    }
    echo '</tbody></table>';
    ?>
</div>