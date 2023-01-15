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
    <h2>Mitarbeiterdaten ändern</h2>
</div>
<div class="container">
    <?php echo Employee::getForm(Employee::getById(substr($action, 10))); ?>
</div>
