<div <?php echo admin_attrs($group_attrs); ?>>

    <label for="<?php echo e($id, false); ?>" class="<?php echo e($viewClass['label'], false); ?> col-form-label"><?php echo e($label, false); ?></label>

    <div class="<?php echo e($viewClass['field'], false); ?>">
        <input type="file" class="<?php echo e($class, false); ?>" name="<?php echo e($name, false); ?>[]" <?php echo $attributes; ?> />
        <?php if(isset($sortable)): ?>
        <input type="hidden" class="<?php echo e($class, false); ?>_sort" name="<?php echo e($sort_flag."[$name]", false); ?>"/>
        <?php endif; ?>

        <?php echo $__env->make('admin::form.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin::form.help-block', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>
</div>

<?php if($settings['showDrag']): ?>
    <script require="sortable" <?php
    $vars = get_defined_vars();
    echo "selector='{$vars['selector']}' nested='{$vars['nested']}'";
?>>
        window.Sortable = Sortable;
    </script>
<?php endif; ?>

<script require="fileinput" <?php
    $vars = get_defined_vars();
    echo "selector='{$vars['selector']}' nested='{$vars['nested']}'";
?>>
    $(this).fileinput(<?php echo json_encode($options, 15, 512) ?>);

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

    <?php if($settings['showDrag']): ?>
    $(this).on('filesorted', function(event, params) {
        var order = [];
        params.stack.forEach(function (item) {
            order.push(item.key);
        });
        $("input<?php echo e($selector, false); ?>_sort").val(order);
    });
    <?php endif; ?>
</script>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/form/multiplefile.blade.php ENDPATH**/ ?>