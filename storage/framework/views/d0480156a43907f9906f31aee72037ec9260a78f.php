<span class="dropdown column-filter">
    <form action="<?php echo $action; ?>" pjax-container style="display: inline-block;">
    <a href="javascript:void(0);" class="dropdown-toggle <?php echo e(empty($value) ? '' : 'text-yellow', false); ?>" data-toggle="dropdown">
        <i class="fa fa-filter"></i>
    </a>
    <ul class="dropdown-menu" role="menu">
        <li class="dropdown-item">
            <input type="text" name="<?php echo e($name, false); ?>" value="<?php echo e($value, false); ?>" class="form-control input-sm <?php echo e($class, false); ?>" autocomplete="off"/>
        </li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item text-right">
            <button class="btn btn-sm btn-<?php echo "info";?> column-filter-submit float-left" data-loading-text="<?php echo e(__("admin.search"), false); ?>..."><i class="fa fa-search"></i>&nbsp;&nbsp;<?php echo e(__("admin.search"), false); ?></button>
            <button class="btn btn-sm btn-default column-filter-all" data-loading-text="..."><i class="fa fa-undo"></i></button>
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
</style>

<script>
    $('.column-filter .dropdown-menu input').click(function(e) {
        e.stopPropagation();
    });
</script>

<?php if($dp): ?>
<script require="datetimepicker">
    $('.<?php echo e($class, false); ?>').datetimepicker(<?php echo json_encode($dp, 15, 512) ?>);
</script>
<?php endif; ?>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/table/column/input-filter.blade.php ENDPATH**/ ?>