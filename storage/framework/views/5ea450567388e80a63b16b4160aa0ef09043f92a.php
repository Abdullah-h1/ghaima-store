<div class="input-group">
    <?php if($group): ?>
    <div class="input-group-prepend show">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="min-width: 32px;">
            <span class="<?php echo e($group_name, false); ?>-label"><?php echo e($default['label'], false); ?></span>
        </button>
        <input type="hidden" name="<?php echo e($id, false); ?>_group" class="<?php echo e($group_name, false); ?>-operation" value="0"/>
        <div class="dropdown-menu <?php echo e($group_name, false); ?>">
            <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="dropdown-item" href="#" data-index="<?php echo e($index, false); ?>"> <?php echo e($item['label'], false); ?> </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php else: ?>
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-<?php echo e($icon, false); ?>"></i></span>
    </div>
    <?php endif; ?>

    <input type="<?php echo e($type, false); ?>" class="form-control <?php echo e($id, false); ?>" placeholder="<?php echo e($placeholder, false); ?>" name="<?php echo e($name, false); ?>" value="<?php echo e(request($name, $value), false); ?>">
</div>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/table/filter/text.blade.php ENDPATH**/ ?>