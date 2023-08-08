<div <?php echo admin_attrs($group_attrs); ?>>

    <label for="<?php echo e($id, false); ?>" class="<?php echo e($viewClass['label'], false); ?> col-form-label"><?php echo e($label, false); ?></label>

    <div class="<?php echo e($viewClass['field'], false); ?>">
        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php echo $inline ? admin_color('<span class="icheck-%s">') : admin_color('<div class="radio icheck-%s">'); ?>

                <input
                    id="<?php
if (!isset($__uniqid)) {
    $__uniqid = uniqid();
    echo $__uniqid;
} else {
    echo $__uniqid;
    unset($__uniqid);
}
?>"
                    type="radio"
                    name="<?php echo e($name, false); ?>"
                    value="<?php echo e($option, false); ?>"
                    class="minimal <?php echo e($class, false); ?>"
                    <?php echo e(($option == $value) || ($value === null && in_array($label, $checked)) ?'checked':'', false); ?>

                    <?php echo $attributes; ?>

                />
                <label for="<?php
if (!isset($__uniqid)) {
    $__uniqid = uniqid();
    echo $__uniqid;
} else {
    echo $__uniqid;
    unset($__uniqid);
}
?>">&nbsp;<?php echo e($label, false); ?>&nbsp;&nbsp;</label>

            <?php echo $inline ? '</span>' :  '</div>'; ?>


        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('admin::form.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin::form.help-block', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>
</div>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/form/radio.blade.php ENDPATH**/ ?>