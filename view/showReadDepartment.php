<div class="container">
    <div class="row">
        <form action="index.php" method="post">
            <?php
            echo '<h2>Abteilungen</h2>';
            echo '<br>';
            echo '<div class="row">';
            echo '<table><thead>';
            echo '<tr><td class="headers">ID</td><td class="headers">Name</td><td></td><td></td>';
            $readArr = Department::getAll();
            for ($i = 0; $i < count($readArr); $i++) {
                $currentId = $readArr[$i]->getId();
                echo '<tr><td>' . $currentId . '</td><td>' . $readArr[$i]->getDptName() .
                    '</td><td><button class="btn waves-effect waves-light" name="action" value="showUpdate' .
                    $currentId . '" type="submit" id="' . $currentId . '">Ändern</button></td>' .
                    '<td><button class="btn waves-effect waves-light" name="action" value="delete' .
                    $currentId . '" type="submit" id="' . $currentId . '">Löschen</button></td>' .
                    '</tr><br>';
            }
            echo '</tbody></table>';
            echo '</div>'
            ?>
        </form>
    </div>
</div>