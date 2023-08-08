<div <?php echo admin_attrs($group_attrs); ?>>
    <label class="<?php echo e($viewClass['label'], false); ?> col-form-label"><?php echo e($label, false); ?></label>
    <div class="<?php echo e($viewClass['field'], false); ?>">
        <div class="card card-solid card-default m-0">
            <!-- /.card-header -->
            <div class="card-body py-2 px-4">
                <?php echo $value; ?>&nbsp;
            </div><!-- /.card-body -->
        </div>
        <?php echo $__env->make('admin::form.help-block', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/form/display.blade.php ENDPATH**/ ?>