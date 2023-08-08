<div class="form-group row mb-3">
    <label class="col-<?php echo e($width['label'], false); ?> col-form-label text-right"><?php echo e($label, false); ?></label>
    <div class="col-<?php echo e($width['field'], false); ?>">
        <?php if($wrapped): ?>
        <div class="card card-solid m-0 card-show">
            <!-- /.card-header -->
            <div class="card-body py-2 px-3">
                <?php if($escape): ?>
                    <?php echo e($content, false); ?>&nbsp;
                <?php else: ?>
                    <?php echo $content; ?>&nbsp;
                <?php endif; ?>
            </div><!-- /.card-body -->
        </div>
        <?php else: ?>
            <?php if($escape): ?>
                <?php echo e($content, false); ?>

            <?php else: ?>
                <?php echo $content; ?>

            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>


<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/show/field.blade.php ENDPATH**/ ?>