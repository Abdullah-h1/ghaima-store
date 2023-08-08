<button id="<?php
if (!isset($__uniqid)) {
    $__uniqid = uniqid();
    echo $__uniqid;
} else {
    echo $__uniqid;
    unset($__uniqid);
}
?>" class="icon btn btn-<?php echo "info";?> <?php echo e($class, false); ?>" data-icon="<?php echo e($value ?: $default, false); ?>" name="<?php echo e($name, false); ?>"></button>

<script require="iconpicker" <?php
    $vars = get_defined_vars();
    echo "selector='{$vars['selector']}' nested='{$vars['nested']}'";
?>>
    $(this).iconpicker({
        arrowClass: 'btn-<?php echo "info";?>',
        selectedClass: 'btn-<?php echo "info";?>',
        unselectedClass: '',
        placement: 'right',
    });
</script>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/form/iconpicker-prepend.blade.php ENDPATH**/ ?>