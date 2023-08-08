<div class="form-group row">
    <label class="col-2 col-form-label text-right"> <?php echo e($label, false); ?></label>
    <div class="col-8">
        <?php echo $__env->make($presenter->view(), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/table/filter/where.blade.php ENDPATH**/ ?>