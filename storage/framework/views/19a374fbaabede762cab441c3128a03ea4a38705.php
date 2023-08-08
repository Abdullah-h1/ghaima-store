<div class="btn-group float-right mr-2">
    <a href="<?php echo e($all, false); ?>" target="_blank" class="btn btn-sm btn-default" title="<?php echo e(admin_trans('admin.export'), false); ?>">
        <i class="fa fa-download"></i>
        <span class="hidden-xs"> <?php echo e(admin_trans('admin.export'), false); ?></span>
    </a>
    <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <a href="<?php echo e($all, false); ?>" target="_blank" class="dropdown-item"><?php echo e(admin_trans('admin.all'), false); ?></a>
        <a href="<?php echo e($page, false); ?>" target="_blank" class="dropdown-item"><?php echo e(admin_trans('admin.current_page'), false); ?></a>
        <a href="<?php echo e($selected, false); ?>" target="_blank" class='<?php echo e($name, false); ?> dropdown-item d-none'><?php echo e(admin_trans('admin.selected_rows'), false); ?></a>
    </ul>
</div>

<script selector=".<?php echo e($name, false); ?>">
    $(this).click(function (e) {
        e.preventDefault();
        var rows = $.admin.table.selected().join();
        if (!rows) {
            return false;
        }
        var href = $(this).attr('href').replace('__rows__', rows);
        location.href = href;
    });

    var $btn = $(this);

    $.admin.on('table-select', function (e, num) {
        if (num > 0) {
            $btn.removeClass('d-none');
        } else {
            $btn.addClass('d-none');
        }
    });
</script>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/table/export-btn.blade.php ENDPATH**/ ?>