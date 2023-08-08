<label class="float-right perpage-selector d-inline-block">
    <?php echo e(admin_trans('admin.show'), false); ?>

    <span class="dropup">
        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
            <?php echo e($perpage, false); ?>

        </a>
        <div class="dropdown-menu">
        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo request()->fullUrlWithQuery([$name => $option]); ?>" class="<?php echo e($perpage == $option ? 'active' : '', false); ?> dropdown-item"><?php echo e($option, false); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </span>
    &nbsp;<?php echo e(admin_trans('admin.entries'), false); ?>

</label>

<style>
    .perpage-selector {
        margin: 5px 10px 0 0;
        color: #777;
        font-weight: 400;
    }
    .perpage-selector a {
        color: #777;
    }
    .perpage-selector .dropdown-menu {
        min-width: 70px;
        left: -20px;
        box-shadow: 0 6px 12px rgba(0,0,0,.175);
    }
    .perpage-selector .dropdown-menu a.active {
        background-color: #d2d6de;
    }
</style>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/table/perpage-selector.blade.php ENDPATH**/ ?>