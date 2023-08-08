<div <?php echo admin_attrs($group_attrs); ?>>

    <label for="<?php echo e($id, false); ?>" class="<?php echo e($viewClass['label'], false); ?> col-form-label"><?php echo e($label, false); ?></label>

    <div class="<?php echo e($viewClass['field'], false); ?>">
        <textarea name="<?php echo e($name, false); ?>" class="form-control <?php echo e($class, false); ?>" rows="<?php echo e($rows, false); ?>" placeholder="<?php echo e($placeholder, false); ?>" <?php echo $attributes; ?> ><?php echo e($value, false); ?></textarea>

        <?php if($picker): ?>
        <div class="text-right textarea-picker">
            <button type="button" class="btn btn-<?php echo "info";?> text-white" data-toggle="modal" data-target="#<?php echo e($picker->modal, false); ?>">
                <i class="fa fa-folder-open"></i>  <?php echo e(admin_trans('admin.browse'), false); ?>

            </button>
        </div>
        <?php endif; ?>
        <?php echo $__env->make('admin::form.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin::form.help-block', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>
</div>

<?php if($picker): ?>
<style>
    .textarea-picker {
        padding: 5px;
        border-bottom: 1px solid #d2d6de;
        border-left: 1px solid #d2d6de;
        border-right: 1px solid #d2d6de;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
        background-color: #f1f2f3;
    }

    .textarea-picker .btn {
        padding: 5px 10px;
        font-size: 12px;
        line-height: 1.5;
    }
</style>
<?php endif; ?>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/form/textarea.blade.php ENDPATH**/ ?>