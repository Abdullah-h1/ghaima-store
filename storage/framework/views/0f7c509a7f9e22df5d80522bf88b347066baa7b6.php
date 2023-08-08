<div class="card card-<?php echo "info";?> card-outline">
    <div class="card-header">
        <h3 class="card-title"><?php echo e($form->title(), false); ?></h3>

        <div class="card-tools">
            <?php echo $form->renderTools(); ?>

        </div>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <?php echo $form->open(); ?>


    <div class="card-body">

        <?php if(!$tabObj->isEmpty()): ?>
            <?php echo $__env->make('admin::form.tab', compact('tabObj'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            <div class="fields-group">

                <?php if($form->hasRows()): ?>
                    <?php $__currentLoopData = $form->getRows(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $row->render(); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <?php $__currentLoopData = $layout->columns(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php $__currentLoopData = $column->fields(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $field->render(); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>
    <!-- /.card-body -->

    <?php echo $form->renderFooter(); ?>


    <?php $__currentLoopData = $form->getHiddenFields(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $field->render(); ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<!-- /.card-footer -->
    <?php echo $form->close(); ?>

</div>

<?php if(!$tabObj->isEmpty()): ?>
<script>
    var hash = document.location.hash;
    if (hash) {
        $('.nav-tabs a[href="' + hash + '"]').tab('show');
    }

    // Change hash for page-reload
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        history.pushState(null,null, e.target.hash);
    });

    if ($('.has-error').length) {
        $('.has-error').each(function () {
            var tabId = '#'+$(this).closest('.tab-pane').attr('id');
            $('li a[href="'+tabId+'"] i').removeClass('d-none');
        });

        var first = $('.has-error:first').closest('.tab-pane').attr('id');
        $('li a[href="#'+first+'"]').tab('show');
    }
</script>
<?php endif; ?>

<?php if($confirm): ?>
<script selector="form.<?php echo e($class, false); ?>">
    var $form = $(this);
    $form.find('button[type=submit]').click(function (e) {
        e.preventDefault();
        $.admin.confirm({title: "<?php echo e($confirm, false); ?>",}).then(function (result) {
            if (result.value) {
                $form.submit();
            }
        });
    });
</script>
<?php endif; ?>

<script selector="form.<?php echo e($class, false); ?>">
    $.admin.initForm($(this));
</script>

<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/form.blade.php ENDPATH**/ ?>