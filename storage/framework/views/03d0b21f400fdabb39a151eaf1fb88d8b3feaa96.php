<div class="icheck-<?php echo "info";?> d-inline">
    <input type="checkbox" class="table-row-checkbox" data-id="<?php echo e($key, false); ?>" id="<?php
if (!isset($__uniqid)) {
    $__uniqid = uniqid();
    echo $__uniqid;
} else {
    echo $__uniqid;
    unset($__uniqid);
}
?>-<?php echo e($key, false); ?>">
    <label for="<?php
if (!isset($__uniqid)) {
    $__uniqid = uniqid();
    echo $__uniqid;
} else {
    echo $__uniqid;
    unset($__uniqid);
}
?>-<?php echo e($key, false); ?>"></label>
</div>

<script require="icheck">
    $('.table-row-checkbox').on('change', function () {
        $.admin.table[this.checked ? 'select' : 'unselect']($(this).data('id'));
    });
</script>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/table/display/row-selector.blade.php ENDPATH**/ ?>