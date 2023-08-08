<div class="card card-<?php echo "info";?> card-outline">

    <div class="card-header">

        <div class="btn-group">
            <button class="btn btn-<?php echo "info";?> btn-sm <?php echo e($id, false); ?>-tree-tools" data-action="expand" title="<?php echo e(admin_trans('admin.expand'), false); ?>">
                <i class="fa fa-plus-square-o"></i>&nbsp;<?php echo e(admin_trans('admin.expand'), false); ?>

            </button>
            <button class="btn btn-<?php echo "info";?> btn-sm <?php echo e($id, false); ?>-tree-tools" data-action="collapse" title="<?php echo e(admin_trans('admin.collapse'), false); ?>">
                <i class="fa fa-minus-square-o"></i>&nbsp;<?php echo e(admin_trans('admin.collapse'), false); ?>

            </button>
        </div>

        <?php if($useSave): ?>
        <div class="btn-group">
            <button class="btn btn-<?php echo "info";?> btn-sm <?php echo e($id, false); ?>-save" title="<?php echo e(admin_trans('admin.save'), false); ?>"><i class="fa fa-save"></i><span class="hidden-xs">&nbsp;<?php echo e(admin_trans('admin.save'), false); ?></span></button>
        </div>
        <?php endif; ?>

        <div class="btn-group">
            <?php echo $tools; ?>

        </div>

        <?php if($useCreate): ?>
        <div class="btn-group float-right">
            <a class="btn btn-success btn-sm" href="<?php echo e(url($path), false); ?>/create"><i class="fa fa-save"></i><span class="hidden-xs">&nbsp;<?php echo e(admin_trans('admin.new'), false); ?></span></a>
        </div>
        <?php endif; ?>

    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <div class="dd" id="<?php echo e($id, false); ?>">
            <ol class="dd-list">
                <?php echo $__env->renderEach($branchView, $items, 'branch'); ?>
            </ol>
        </div>
    </div>
    <!-- /.card-body -->
</div>

<script require="nestable">
    $('#<?php echo e($id, false); ?>').nestable(<?php echo json_encode($options, 15, 512) ?>);

    $('.<?php echo e($id, false); ?>-save').click(function () {
        var serialize = $('#<?php echo e($id, false); ?>').nestable('serialize');
        $.post('<?php echo e($url, false); ?>', {
            _order: JSON.stringify(serialize)
        },
        function(data){
            $.admin.reload('<?php echo e(admin_trans('admin.save_succeeded'), false); ?>');
        });
    });

    $('.<?php echo e($id, false); ?>-tree-tools').on('click', function(e){
        var action = $(this).data('action');
        if (action === 'expand') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse') {
            $('.dd').nestable('collapseAll');
        }
    });
</script>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/tree.blade.php ENDPATH**/ ?>