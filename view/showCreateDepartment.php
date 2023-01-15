<div class="container">
    <h2>Neue Abteilung</h2>
</div>
<div class="container">
    <div class="row">
        <form class="col s12" action="index.php" method="post">
            <div class="row">
                <div class="input-field col s12">
                    <input id="first_name" type="text" class="validate" name="firstName">
                    <label for="first_name">Name</label>
                </div>
            </div>
            <div class="row">
                <input type="hidden" name="area" value="department">
                <button class="btn waves-effect waves-light" name="action" value="create" type="submit">
                    Hinzufügen<i
                            class="material-icons right">+</i></button>
            </div>
        </form>
    </div>
</div>