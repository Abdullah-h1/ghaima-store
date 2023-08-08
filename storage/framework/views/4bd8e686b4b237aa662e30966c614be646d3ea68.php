<div class="input-group">
    <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $inline ? admin_color('<span class="icheck-%s">') : admin_color('<div class="checkbox icheck-%s">'); ?>

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
            type="checkbox"
            class="<?php echo e($id, false); ?>"
            name="<?php echo e($name, false); ?>[]"
            value="<?php echo e($option, false); ?>"
            class="minimal"
            <?php echo e(in_array((string)$option, request($name, is_null($value) ? [] : $value)) ? 'checked' : '', false); ?>

        />
        <label for="<?php
if (!isset($__uniqid)) {
    $__uniqid = uniqid();
    echo $__uniqid;
} else {
    echo $__uniqid;
    unset($__uniqid);
}
?>">
            &nbsp;<?php echo e($label, false); ?>&nbsp;&nbsp;
        </label>
        <?php echo $inline ? '</span>' :  '</div>'; ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/table/filter/checkbox.blade.php ENDPATH**/ ?>