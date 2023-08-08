<?php if(admin_user()->canSeeMenu($item)): ?>
    <?php if(!isset($item['children'])): ?>
        <li class="nav-item">
            <?php if(url()->isValidUrl($item['uri'])): ?>
                <a href="<?php echo e($item['uri'], false); ?>" target="_blank" class="nav-link">
            <?php else: ?>
                 <a href="<?php echo e(admin_url($item['uri']), false); ?>" class="nav-link">
            <?php endif; ?>
                <i class="nav-icon <?php echo e($item['icon'], false); ?>"></i>
                <p><?php echo e(admin_trans($item['title']), false); ?></p>
            </a>
        </li>
    <?php else: ?>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon <?php echo e($item['icon'], false); ?>" ></i>
                <p>
                    <?php echo e(admin_trans($item['title']), false); ?>

                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <?php $__currentLoopData = $item['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('admin::partials.menu', $item, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </li>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/partials/menu.blade.php ENDPATH**/ ?>