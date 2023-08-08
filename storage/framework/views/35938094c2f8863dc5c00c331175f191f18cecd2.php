<?php if($help): ?>
<div class="mt-2 text-secondary">
    <i class="fa <?php echo e(\Illuminate\Support\Arr::get($help, 'icon'), false); ?>"></i>&nbsp;<?php echo \Illuminate\Support\Arr::get($help, 'text'); ?>

</div>
<?php endif; ?>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/form/help-block.blade.php ENDPATH**/ ?>