<link href="../../../css/bootstrap/bootstrap-colorpicker.min.css" rel="stylesheet">
<script src="../../../js/jquery/jquery.min.js"></script>

<script src="../../../js/bootstrap/bootstrap-colorpicker.js"></script>

<div <?php echo admin_attrs($group_attrs); ?>>
    <label for="<?php echo e($id, false); ?>" class="<?php echo e($viewClass['label'], false); ?> col-form-label"><?php echo e($label, false); ?></label>
    <div class="<?php echo e($viewClass['field'], false); ?>">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-palette fa-fw"></i>
                </span>
            </div>
            
            <input id="my_color_picker" type="text" name="<?php echo e($name, false); ?>" value="<?php echo e(old($column, $value), false); ?>" class="form-control field-code" placeholder="<?php echo e($placeholder, false); ?>">

            
            
        </div>
        <?php echo $__env->make('admin::form.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin::form.help-block', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        console.log('sadadad');
        $('#my_color_picker').colorpicker();
        
        
    });
    	
        
    
</script><?php /**PATH D:\GhaimaStore\ghaima\resources\views/admin/colorpicker2.blade.php ENDPATH**/ ?>