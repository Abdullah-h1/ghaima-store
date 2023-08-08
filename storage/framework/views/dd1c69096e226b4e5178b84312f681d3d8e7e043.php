<span class="dropdown column-filter">
<form action="<?php echo e($action, false); ?>" pjax-container style="display: inline-block;">
    <a href="javascript:void(0);" class="dropdown-toggle <?php echo e(empty($value) ? '' : 'text-yellow', false); ?>" data-toggle="dropdown">
        <i class="fa fa-filter"></i>
    </a>
    <ul class="dropdown-menu" role="menu" style="padding: 10px;box-shadow: 0 2px 3px 0 rgba(0,0,0,.2);left: -70px;border-radius: 0;">

        <li class="dropdown-item checkbox icheck-<?php echo "info";?>" style="margin: 0;">
            <input id="<?php
if (!isset($__uniqid)) {
    $__uniqid = uniqid();
    echo $__uniqid;
} else {
    echo $__uniqid;
    unset($__uniqid);
}
?>" type="checkbox" class="<?php echo e($class['all'], false); ?>" <?php echo e($allCheck, false); ?>/>
            <label style="width: 100%;padding: 3px;" for="<?php
if (!isset($__uniqid)) {
    $__uniqid = uniqid();
    echo $__uniqid;
} else {
    echo $__uniqid;
    unset($__uniqid);
}
?>">
                &nbsp;&nbsp;&nbsp;<?php echo e(__('admin.all'), false); ?>

            </label>
        </li>
        <li class="dropdown-divider"></li>
        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="dropdown-item checkbox icheck-<?php echo "info";?>" style="margin: 0;">
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
                class="<?php echo e($class['item'], false); ?>"
                name="<?php echo e($name, false); ?>[]"
                value="<?php echo e($key, false); ?>"
                <?php echo e(in_array($key, $value) ? 'checked' : '', false); ?>/>
            <label style="width: 100%;padding: 3px;" for="<?php
if (!isset($__uniqid)) {
    $__uniqid = uniqid();
    echo $__uniqid;
} else {
    echo $__uniqid;
    unset($__uniqid);
}
?>">
                &nbsp;&nbsp;&nbsp;<?php echo e($label, false); ?>

            </label>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <li class="dropdown-divider"></li>
        <li class="dropdown-item text-right">
            <button class="btn btn-sm btn-<?php echo "info";?> float-left" data-loading-text="<?php echo e(__('admin.search'), false); ?>..."><i class="fa fa-search"></i>&nbsp;&nbsp;<?php echo e(__('admin.search'), false); ?></button>
            <button class="btn btn-sm btn-default" type="reset" data-loading-text="..."><i class="fa fa-undo"></i></button>
        </li>
    </ul>
</form>
</span>

<style>
    .column-filter .dropdown-menu {
        padding: 10px;
        top: 12px !important;
    }

    .column-filter .dropdown-item {
        padding: 0.25rem 0rem;
    }

    .column-filter [class*=icheck-] {
         margin-top: 0px!important;
         margin-bottom: 0px!important;
    }
</style>

<script>
    $('.<?php echo e($class['all'], false); ?>').change(function () {
        $('.<?php echo e($class['item'], false); ?>').prop('checked', this.checked);
        return false;
    });
</script>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/table/column/check-filter.blade.php ENDPATH**/ ?>