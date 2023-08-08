<?php if(!$holdAll): ?>
<div class="btn-group table-select-all-btn mr-2" style="display:none;">
    <a class="btn btn-sm btn-default hidden-xs"><span class="selected" data-tpl="<?php echo e(admin_trans('admin.table_items_selected'), false); ?>"></span></a>
    <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <?php if(!$actions->isEmpty()): ?>
    <ul class="dropdown-menu" role="menu">
        <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($action instanceof \Encore\Admin\Actions\BatchAction): ?>
                <li><?php echo $action->render(); ?></li>
            <?php else: ?>
                <li><a href="#" class="<?php echo e($action->getElementClass(false), false); ?>"><?php echo $action->render(); ?> </a></li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <?php endif; ?>
</div>
<?php endif; ?>

<script selector=".table-select-all-btn">

    $('.table-select-all').on('change', function(event) {
        $.admin.table.toggleAll(this.checked);
    });

    var $btn = $(this);

    $.admin.on('table-select', function (e, num) {
        if (num > 0) {
            $btn.show();
            var $select = $btn.find('.selected');
            $select.html($select.data('tpl').replace('{n}', num));
        } else {
            $btn.hide();
        }
    });
</script>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/table/batch-actions.blade.php ENDPATH**/ ?>