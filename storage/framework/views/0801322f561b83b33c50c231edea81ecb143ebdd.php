<?php (\Illuminate\Support\Arr::forget($group_attrs, 'class')); ?>

<div class="row">
    <div class="<?php echo e($viewClass['label'], false); ?>">
        <label class="float-right"><?php echo e($label, false); ?></label>
    </div>
    <div class="<?php echo e($viewClass['field'], false); ?>"></div>
</div>

<hr class="pt-0">

<div id="has-many-<?php echo e($column, false); ?>" class="has-many-<?php echo e($column, false); ?> form-group" <?php echo admin_attrs($group_attrs); ?>>
    <div class="has-many-<?php echo e($column, false); ?>-forms">
        <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pk => $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="has-many-<?php echo e($column, false); ?>-form fields-group" data-key="<?php echo e($pk, false); ?>">
            <?php $__currentLoopData = $form->fields(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $field->render(); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($options['allowDelete']): ?>
            <div class="form-group row">
                <label class="<?php echo e($viewClass['label'], false); ?>"></label>
                <div class="<?php echo e($viewClass['field'], false); ?>">
                    <div class="remove btn btn-warning btn-sm float-right">
                        <i class="fa fa-trash">&nbsp;</i><?php echo e(admin_trans('admin.remove'), false); ?>

                    </div>
                </div>
            </div>
            <?php endif; ?>
            <hr>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <template class="<?php echo e($column, false); ?>-tpl">
        <div class="has-many-<?php echo e($column, false); ?>-form fields-group" data-key="new_<?php echo e(\Encore\Admin\Form\NestedForm::DEFAULT_KEY_NAME, false); ?>">

            <?php echo $template; ?>


            <div class="form-group row">
                <label class="<?php echo e($viewClass['label'], false); ?> col-form-label"></label>
                <div class="<?php echo e($viewClass['field'], false); ?>">
                    <div class="remove btn btn-warning btn-sm float-right">
                        <i class="fa fa-trash"></i>&nbsp;<?php echo e(admin_trans('admin.remove'), false); ?>

                    </div>
                </div>
            </div>
            <hr>
        </div>
    </template>

    <?php if($options['allowCreate']): ?>
    <div class="form-group row">
        <label class="<?php echo e($viewClass['label'], false); ?> col-form-label"></label>
        <div class="<?php echo e($viewClass['field'], false); ?>">
            <div class="add btn btn-success btn-sm"><i class="fa fa-save"></i>&nbsp;<?php echo e(admin_trans('admin.new'), false); ?></div>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
    var index = 0;
    $('#has-many-<?php echo e($column, false); ?>').off('click', '.add').on('click', '.add', function () {
        var tpl = $('template.<?php echo e($column, false); ?>-tpl');
        index++;
        var template = tpl.html().replace(/<?php echo e(\Encore\Admin\Form\NestedForm::DEFAULT_KEY_NAME, false); ?>/g, index);
        $('.has-many-<?php echo e($column, false); ?>-forms').append(template);
        return false;
    });

    $('#has-many-<?php echo e($column, false); ?>').off('click', '.remove').on('click', '.remove', function () {
        var $form = $(this).closest('.has-many-<?php echo e($column, false); ?>-form');
        $form.find('input').removeAttr('required');
        $form.hide();
        $form.find('.<?php echo e(\Encore\Admin\Form\NestedForm::REMOVE_FLAG_CLASS, false); ?>').val(1);
        return false;
    });
</script>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/form/hasmany.blade.php ENDPATH**/ ?>