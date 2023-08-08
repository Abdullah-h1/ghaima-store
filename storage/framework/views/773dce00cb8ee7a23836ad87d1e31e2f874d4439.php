<div <?php echo admin_attrs($group_attrs); ?>>

    <label for="<?php echo e($id, false); ?>" class="<?php echo e($viewClass['label'], false); ?> col-form-label"><?php echo e($label, false); ?></label>

    <div class="<?php echo e($viewClass['field'], false); ?>">
        <div class="card-group btn-group-toggle radio-card-group">
            <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label class="card <?php echo e(($option == $value) || ($value === null && in_array($label, $checked)) ?admin_color('bg-%s'):'', false); ?>">
                    <div class="card-body">
                    <input type="radio" name="<?php echo e($name, false); ?>" value="<?php echo e($option, false); ?>" class="<?php echo e($class, false); ?> d-none" <?php echo e(($option == $value) || ($value === null && in_array($label, $checked)) ?'checked':'', false); ?> <?php echo $attributes; ?> />&nbsp;<?php echo e($label, false); ?>&nbsp;&nbsp;
                    </div>
                </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php echo $__env->make('admin::form.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin::form.help-block', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>
</div>

<script>
    $('.radio-card-group label').click(function () {
        $(this).addClass('bg-<?php echo "info";?>').siblings().removeClass('bg-<?php echo "info";?>');
    });
</script>

<style>
    .card-group label {
        cursor: pointer;
        margin-right: 8px;
        font-weight: 400;
    }

    .card-group .card {
        margin-bottom: 0px;
    }

    .card-group .card-body {
        padding: 10px 15px;
    }
</style>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/form/radiocard.blade.php ENDPATH**/ ?>