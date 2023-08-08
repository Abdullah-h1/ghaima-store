<div <?php echo admin_attrs($group_attrs); ?>>
    <label for="<?php echo e($id, false); ?>" class="<?php echo e($viewClass['label'], false); ?> col-form-label"><?php echo e($label, false); ?></label>
    <div class="<?php echo e($viewClass['field'], false); ?>">
        <input type="checkbox" class="form-control <?php echo e($class, false); ?>" <?php echo e($value == $state['on']['value'] ? 'checked' : '', false); ?> <?php echo $attributes; ?> />
        <input type="hidden" name="<?php echo e($name, false); ?>" value="<?php echo e($value, false); ?>" />
        <?php echo $__env->make('admin::form.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin::form.help-block', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>

<script require="toggle" <?php
    $vars = get_defined_vars();
    echo "selector='{$vars['selector']}' nested='{$vars['nested']}'";
?>>
    $(this).bootstrapToggle().change(function () {
        $(this).parents('.fields-group')
            .find('input[type=hidden][name=<?php echo e($name, false); ?>]')
            .val(this.checked ? '<?php echo e($state['on']['value'], false); ?>':'<?php echo e($state['off']['value'], false); ?>');
    });
</script>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/form/switchfield.blade.php ENDPATH**/ ?>