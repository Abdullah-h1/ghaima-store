<div class="card-footer row">

    <div class="col-md-<?php echo e($width['label'], false); ?>">
    </div>

    <div class="col-md-<?php echo e($width['field'], false); ?>">

        <?php if(in_array('submit', $buttons)): ?>
        <div class="btn-group float-right">
            <button type="submit" class="btn btn-<?php echo "info";?>"><?php echo e(admin_trans('admin.submit'), false); ?></button>
        </div>

        <?php $__currentLoopData = $submit_redirects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $redirect): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(in_array($redirect, $checkboxes)): ?>
            <span class="icheck-default">
                <input id="<?php
if (!isset($__uniqid)) {
    $__uniqid = uniqid();
    echo $__uniqid;
} else {
    echo $__uniqid;
    unset($__uniqid);
}
?>" type="checkbox" class="after-submit" name="_saved" value="<?php echo e($value, false); ?>" <?php echo e(($default_check == $redirect) ? 'checked' : '', false); ?>>
                <label for="<?php
if (!isset($__uniqid)) {
    $__uniqid = uniqid();
    echo $__uniqid;
} else {
    echo $__uniqid;
    unset($__uniqid);
}
?>" class="float-right" style="margin: 5px 10px 0 0;">
                     <?php echo e(admin_trans("admin.{$redirect}"), false); ?>

                </label>
            </span>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php endif; ?>

        <?php if(in_array('reset', $buttons)): ?>
        <div class="btn-group float-left">
            <button type="reset" class="btn btn-warning"><?php echo e(admin_trans('admin.reset'), false); ?></button>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/form/footer.blade.php ENDPATH**/ ?>