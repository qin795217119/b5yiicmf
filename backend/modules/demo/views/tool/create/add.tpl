<?php $this->context->layout = '/form';?>

<form class="form-horizontal m" id="form-add">
___REPLACE___
</form>

<?php $this->beginBlock('script'); ?>
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-add').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
