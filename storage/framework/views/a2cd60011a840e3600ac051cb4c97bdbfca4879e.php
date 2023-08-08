<div class="table-dropdown-actions dropdown">
    <a href="javascript:void(0);" style="padding: 0 10px;" data-toggle="dropdown">
        <i class="fa fa-ellipsis-v"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right" style="min-width: 70px !important;box-shadow: 0 2px 3px 0 rgba(0,0,0,.2);top: 5px;">

        <?php $__currentLoopData = $default; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $action->render(); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if(!empty($custom)): ?>

            <?php if(!empty($default)): ?>
                <div class="divider"></div>
            <?php endif; ?>

            <?php $__currentLoopData = $custom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <?php echo $action->render(); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</div>

<script>
    $('.table-responsive').on('shown.bs.dropdown', function(e) {
        var t = $(this),
            m = $(e.target).find('.dropdown-menu'),
            tb = t.offset().top + t.height(),
            mb = m.offset().top + m.outerHeight(true),
            d = 20;
        if (t[0].scrollWidth > t.innerWidth()) {
            if (mb + d > tb) {
                t.css('padding-bottom', ((mb + d) - tb));
            }
        } else {
            t.css('overflow', 'visible');
        }
    }).on('hidden.bs.dropdown', function() {
        $(this).css({
            'padding-bottom': '',
            'overflow': ''
        });
    });
</script>

<?php if($dblclick): ?>
<script>
    $('body').on('dblclick', 'table#<?php echo e($table, false); ?>>tbody>tr', function(e) {
        $(this).find('.<?php echo e($dblclick, false); ?>').trigger('click');
    });
</script>
<?php endif; ?>

<?php echo $__env->yieldContent('child'); ?>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/table/actions/dropdown.blade.php ENDPATH**/ ?>