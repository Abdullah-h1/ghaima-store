<div class="btn-group dropdown column-selector float-right mr-2">
    <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
        <i class="fas fa-table"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-right" role="menu">
        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        if (empty($visible)) {
            $checked = 'checked';
        } else {
            $checked = in_array($key, $visible) ? 'checked' : '';
        }
        ?>

        <li class="dropdown-item icheck-<?php echo "info";?>">
            <input id="<?php
if (!isset($__uniqid)) {
    $__uniqid = uniqid();
    echo $__uniqid;
} else {
    echo $__uniqid;
    unset($__uniqid);
}
?>" type="checkbox" class="column-select-item" value="<?php echo e($key, false); ?>" <?php echo e($checked, false); ?>/>
            <label for="<?php
if (!isset($__uniqid)) {
    $__uniqid = uniqid();
    echo $__uniqid;
} else {
    echo $__uniqid;
    unset($__uniqid);
}
?>"><?php echo e($label, false); ?></label>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="dropdown-divider"></div>
        <li class="dropdown-item">
            <button class="btn btn-sm btn-default column-select-all float-left"><?php echo e(__('admin.all'), false); ?></button>&nbsp;&nbsp;
            <button class="btn btn-sm btn-<?php echo "info";?> column-select-submit  float-right"><?php echo e(__('admin.submit'), false); ?></button>
        </li>
    </ul>
</div>

<style>
.column-selector .dropdown-menu {
    padding: 10px;
    height: auto;
    max-height: 500px;
    overflow-x: hidden;
}

.column-selector .dropdown-menu ul {
    padding: 0;
}

.column-selector .dropdown-menu ul li {
    margin: 0;
}

.column-selector .dropdown-menu label {
    width: 100%;
}
.column-selector  [class*=icheck-] {
    margin: 0 !important;
}
</style>

<script>
$(".column-selector .dropdown-menu").on("click", function(e) {
    e.stopPropagation();
});

$('.column-select-submit').on('click', function () {

    var defaults = <?php echo json_encode($defaults, 15, 512) ?>;
    var selected = [];

    $('.column-select-item:checked').each(function () {
        selected.push($(this).val());
    });

    if (selected.length == 0) {
        return;
    }

    var url = new URL(location);

    if (selected.sort().toString() == defaults.sort().toString()) {
        url.searchParams.delete('_columns_');
    } else {
        url.searchParams.set('_columns_', selected.join());
    }

    $.admin.redirect(url.toString());
});

$('.column-select-all').on('click', function () {
    $('.column-select-item').prop('checked', true);
    return false;
});
</script>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/table/column-selector.blade.php ENDPATH**/ ?>