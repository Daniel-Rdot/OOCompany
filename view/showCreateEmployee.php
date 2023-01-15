<script>
    $(function () {
        // initialize
        $('.materialSelect').material_select();

        // setup listener for custom event to re-initialize on change
        $('.materialSelect').on('contentChanged', function () {
            $(this).material_select();
        });
    });
</script>
<div class="container">
    <h2>Neuer Mitarbeiter</h2>
</div>
<div class="container">

    <!--    --><?php //echo Employee::getForm(Employee::getById(4)); ?>
    <?php echo Employee::getForm(); ?>
</div>

<!--    <form class="col s12" action="index.php" method="post">-->
<!--        <input type="hidden" name="area" value="employee">-->
<!--        <div class="row">-->
<!--            <div class="input-field col s6">-->
<!--                <input id="first_name" type="text" class="validate" name="firstName">-->
<!--                <label for="first_name">Vorname</label>-->
<!--            </div>-->
<!--            <div class="input-field col s6">-->
<!--                <input id="last_name" type="text" class="validate" name="lastName">-->
<!--                <label for="last_name">Nachname</label>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="row">-->
<!--            <div class="input-field col s6">-->
<!--                <select id="sexDropdown" class="materialSelect" name="sex">-->
<!--                    <option value="" disabled selected>Geschlecht</option>-->
<!--                    <option value="m">Männlich</option>-->
<!--                    <option value="w">Weiblich</option>-->
<!--                </select>-->
<!--            </div>-->
<!--            <div class="input-field col s6">-->
<!--                <input id="salary" type="text" class="validate" name="salary">-->
<!--                <label for="salary">Monatslohn</label>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="row">-->
<!--            <div class="input-field col s6">-->
<!--                <select id="dptDropdown" class="materialSelect" name="departmentId">-->
<!--                    <option value="" disabled selected>Abteilung</option>-->
<!--                    --><?php
//                    echo Department::getSelect();
//                    ?>
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="row">-->
<!--            <button class="btn waves-effect waves-light" name="action" value="create" type="submit">-->
<!--                Hinzufügen<i-->
<!--                        class="material-icons right">+</i></button>-->
<!--        </div>-->
<!--</div>-->
<!--</form>-->