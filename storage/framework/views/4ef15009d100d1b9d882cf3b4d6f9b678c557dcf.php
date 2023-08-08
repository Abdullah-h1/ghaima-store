<form <?php echo $attributes; ?>>
    <div class="card card-outline card-<?php echo "info";?>">

        <div class="card-header">
            <h3 class="card-title"><?php echo e($title, false); ?></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
        </div>


        <div class="card-body">
            <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $field->render(); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- /.card-body -->
        <?php if(count($buttons) > 0): ?>
        <div class="card-footer row">
            <div class="col-<?php echo e($width['label'], false); ?>"></div>

            <div class="col-<?php echo e($width['field'], false); ?>">
                <?php if(in_array('reset', $buttons)): ?>
                <div class="btn-group float-left">
                    <button type="reset" class="btn btn-warning float-right"><?php echo e(admin_trans('admin.reset'), false); ?></button>
                </div>
                <?php endif; ?>

                <?php if(in_array('submit', $buttons)): ?>
                <div class="btn-group float-right">
                    <button type="submit" class="btn btn-<?php echo "info";?> float-right"><?php echo e(admin_trans('admin.submit'), false); ?></button>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

    </div>
</form>

<div class="card card-outline card-<?php echo "info";?> d-none form-result">
    <div class="card-header">
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body"></div>
</div>

<?php if($confirm): ?>
    <script selector="form#<?php echo e($id, false); ?>">
        var $form = $(this);
        $form.find('button[type=submit]').click(function (e) {
            e.preventDefault();
            $.admin.confirm({
                title: "<?php echo e($confirm, false); ?>",
            }).then(function (result) {
                if (result.value) {
                    $form.submit();
                }
            });
        });
    </script>
<?php endif; ?>

<script selector="form#<?php echo e($id, false); ?>">
    $.admin.initForm($(this));
</script>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/widgets/form.blade.php ENDPATH**/ ?>