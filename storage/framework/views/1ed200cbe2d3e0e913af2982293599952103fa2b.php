<div <?php echo admin_attrs($group_attrs); ?>>

    <label for="<?php echo e($id, false); ?>" class="<?php echo e($viewClass['label'], false); ?> col-form-label"><?php echo e($label, false); ?></label>

    <div class="<?php echo e($viewClass['field'], false); ?>">
        <input type="file" class="form-control <?php echo e($class, false); ?>" name="<?php echo e($name, false); ?>" <?php echo $attributes; ?> />
        <?php echo $__env->make('admin::form.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin::form.help-block', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <input type="hidden" class="form-control <?php echo e($class, false); ?>" name="<?php echo e($name, false); ?>" value="<?php echo e($value, false); ?>"/>
</div>

<script require="fileinput" <?php
    $vars = get_defined_vars();
    echo "selector='{$vars['selector']}' nested='{$vars['nested']}'";
?>>

    $(this).fileinput(<?php echo $options; ?>).on('change', function () {
        var this_hidden = $(this).parents('.field-control:first').next();
        if ($(this).val()) {
            this_hidden.prop('disabled', true);
        } else {
            this_hidden.prop('disabled', false);
        }
    });

    <?php if($settings['showRemove']): ?>
    $(this).on('filebeforedelete', function() {
        return new Promise(function(resolve, reject) {
            var remove = resolve;
            $.admin.confirm({
                title: "<?php echo e(admin_trans('admin.delete_confirm'), false); ?>",
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        resolve(remove());
                    });
                }
            });
        });
    });
    <?php endif; ?>
</script>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/form/file.blade.php ENDPATH**/ ?>