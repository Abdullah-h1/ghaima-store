<div <?php echo admin_attrs($group_attrs); ?>>
    <label for="<?php echo e($id, false); ?>" class="<?php echo e($viewClass['label'], false); ?> col-form-label"><?php echo e($label, false); ?></label>
    <div class="<?php echo e($viewClass['field'], false); ?>">
        <div class="input-group" style="width: 300px;">
            <input <?php echo $attributes; ?> />
             <?php if($append): ?>
                <span class="input-group-append"><?php echo $append; ?></span>
            <?php endif; ?>
        </div>
        <?php echo $__env->make('admin::form.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin::form.help-block', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>

<script require="bootstrap-input-spinner" <?php
    $vars = get_defined_vars();
    echo "selector='{$vars['selector']}' nested='{$vars['nested']}'";
?>>
    $(this).inputSpinner();
</script>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/form/number.blade.php ENDPATH**/ ?>