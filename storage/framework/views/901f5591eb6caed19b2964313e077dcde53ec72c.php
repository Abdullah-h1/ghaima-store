<?php if($modal): ?>
    <a href="<?php echo e($url, false); ?>" class="btn btn-sm btn-<?php echo "info";?> table-create-btn mr-2" data-toggle="modal" data-target="#table-create-modal">
        <i class="fa fa-plus"></i><span class="hidden-xs">&nbsp;&nbsp;<?php echo e(admin_trans('admin.new'), false); ?></span>
    </a>
<script>
    $('#table-create-modal').on('show.bs.modal', function (e) {
        if ($(this).data('loaded') != 1) {
            $(this).find('.modal-body').load($(e.relatedTarget).attr('href')+'?_modal');
            $(this).data('loaded', 1);
        }
    });
</script>

    <template>
        <div class="modal fade" tabindex="-1" role="dialog" id="table-create-modal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo e(admin_trans('admin.new'), false); ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
    </template>
<?php else: ?>
    <a href="<?php echo e($url, false); ?>" class="btn btn-sm btn-<?php echo "info";?> table-create-btn mr-2">
        <i class="fa fa-plus"></i><span class="hidden-xs">&nbsp;&nbsp;<?php echo e(admin_trans('admin.new'), false); ?></span>
    </a>
<?php endif; ?>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/table/create-btn.blade.php ENDPATH**/ ?>