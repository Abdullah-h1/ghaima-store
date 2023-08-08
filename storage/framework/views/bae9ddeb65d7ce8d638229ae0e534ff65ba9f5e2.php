<script data-exec-on-popstate>
require(<?php echo json_encode($requires, 15, 512) ?>, function (<?php echo e(implode(',', $exports), false); ?>) {
    <?php $__currentLoopData = $script; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php echo $s; ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
});
</script>

<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/partials/script.blade.php ENDPATH**/ ?>