<div <?php echo admin_attrs($group_attrs); ?>>

    <label for="<?php echo e($id, false); ?>" class="<?php echo e($viewClass['label'], false); ?> col-form-label"><?php echo e($label, false); ?></label>

    <div class="<?php echo e($viewClass['field'], false); ?>">
        <div class="input-group">

            <?php if($prepend): ?>
                <div class="input-group-prepend">
                <?php echo $prepend; ?>

                </div>
            <?php endif; ?>

            <input <?php echo $attributes; ?> />

            <?php if($append): ?>
                <span class="input-group-append"><?php echo $append; ?></span>
            <?php endif; ?>

            <?php if($picker): ?>
                <span class="input-group-append">
                    <button type="button" class="btn btn-<?php echo "info";?> text-white" data-toggle="modal" data-target="#<?php echo e($picker->modal, false); ?>">
                        <i class="fa fa-folder-open"></i>  <?php echo e(admin_trans('admin.browse'), false); ?>

                    </button>
                </span>
            <?php endif; ?>
        </div>

        <?php echo $__env->make('admin::form.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin::form.help-block', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>
</div>

<?php if($inputmask): ?>
    <script require="inputmask" <?php
    $vars = get_defined_vars();
    echo "selector='{$vars['selector']}' nested='{$vars['nested']}'";
?>>
        $(this).inputmask(<?php echo json_encode_options($inputmask); ?>);
    </script>
<?php endif; ?>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/form/input.blade.php ENDPATH**/ ?>