<div class="btn-group mr-2">
    <button type="button" class="btn btn-sm btn-default <?php echo e($btn_class, false); ?>">
        <input type="checkbox" class="d-none"><i class="fa fa-filter"></i><span class="hidden-xs">&nbsp;&nbsp;<?php echo e(admin_trans('admin.filter'), false); ?></span>
    </button>

    <?php if($scopes->isNotEmpty()): ?>
    <div class="btn-group">
        <button type="button" class="btn btn-sm btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
        </button>
        <div class="dropdown-menu">
            <?php $__currentLoopData = $scopes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scope): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $scope->render(); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="dropdown-divider"></div>
            <a href="<?php echo e($cancel, false); ?>" class="dropdown-item"><?php echo e(admin_trans('admin.cancel'), false); ?></a>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
var $btn = $('.<?php echo e($btn_class, false); ?>');
var $filter = $('#<?php echo e($filter_id, false); ?>');

$btn.unbind('click').click(function (e) {
    if ($filter.is(':visible')) {
        $filter.addClass('d-none');
    } else {
        $filter.removeClass('d-none');
    }
});
</script>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/table/filter/button.blade.php ENDPATH**/ ?>