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
    <h2>Abteilungsdaten ändern</h2>
</div>
<div class="container">
    <?php echo Department::getForm(Department::getById(substr($action, 10))); ?>
</div>