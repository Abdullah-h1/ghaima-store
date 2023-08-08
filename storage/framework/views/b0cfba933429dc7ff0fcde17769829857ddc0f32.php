<thead>
<tr class="quick-create">
    <td colspan="<?php echo e($columnCount, false); ?>"
        style="height: 47px;padding-left: 57px;background-color: #f9f9f9; vertical-align: middle;">

            <span class="create" style="color: #bdbdbd;cursor: pointer;display: block;">
                 <i class="fa fa-plus"></i>&nbsp;<?php echo e(__('admin.quick_create'), false); ?>

            </span>

        <form class="form-inline create-form" style="display: none;" method="post">
            <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                &nbsp;<?php echo $field->render(); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            &nbsp;
            <button class="btn btn-<?php echo "info";?> btn-sm"><?php echo e(__('admin.submit'), false); ?></button>&nbsp;
            <a href="javascript:void(0);" class="cancel"><?php echo e(__('admin.cancel'), false); ?></a>
            <?php echo e(csrf_field(), false); ?>

        </form>
    </td>
</tr>
</thead>

<script>
    $('.quick-create .create').click(function () {
        $('.quick-create .create-form').show();
        $(this).hide();
    });

    $('.quick-create .cancel').click(function () {
        $('.quick-create .create-form').hide();
        $('.quick-create .create').show();
    });

    $('.quick-create .create-form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo e(request()->url(), false); ?>',
            type: 'POST',
            data: $(this).serialize(),
        }).done(function (data, textStatus, jqXHR) {
            if (data.status) {
                $.admin.reload(data.message);
                return;
            }

            if (typeof data.validation !== 'undefined') {
                $.admin.toastr.warning(data.message)
            }
        });
        return false;
    });
</script>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/table/quick-create/form.blade.php ENDPATH**/ ?>