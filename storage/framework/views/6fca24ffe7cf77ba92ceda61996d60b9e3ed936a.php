<li class="nav-item">
    <a href="javascript:void(0);" <?php
if (!isset($__id)) {
    $__id = uniqid();
    echo "class='{$__id} nav-link'";
} else {
    echo "$('.{$__id}')";
}
?>>
        <i class="fas fa-sync"></i>
    </a>
</li>
<script>
    <?php
if (!isset($__id)) {
    $__id = uniqid();
    echo "class='{$__id} '";
} else {
    echo "$('.{$__id}')";
}
?>.off('click').on('click', function() {
        $.admin.reload('<?php echo e(admin_trans('admin.refresh_succeeded'), false); ?>');
    });
</script>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/components/refresh-btn.blade.php ENDPATH**/ ?>