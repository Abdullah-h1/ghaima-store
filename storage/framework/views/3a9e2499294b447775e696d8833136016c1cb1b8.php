<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.css"/>
<script src="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.js"></script>

<div <?php echo admin_attrs($group_attrs); ?>>
    <label for="<?php echo e($id, false); ?>" class="<?php echo e($viewClass['label'], false); ?> col-form-label"><?php echo e($label, false); ?></label>
    <div class="<?php echo e($viewClass['field'], false); ?>">
        <div class="input-group" style="width: 200px">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-palette fa-fw"></i>
                </span>
            </div>
            <input id="my_color_picker" type="text" name="<?php echo e($name, false); ?>" value="<?php echo e(old($column, $value), false); ?>" class="form-control field-code" placeholder="<?php echo e($placeholder, false); ?>">

            
            <div class="input-group-prepend">
                <span class="input-group-text">
                </span> 
             </div>
        </div>
        <?php echo $__env->make('admin::form.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin::form.help-block', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>



<script>
    document.querySelector('#my_color_picker').addEventListener('click', e => {
        Coloris({
          theme: 'polaroid',
            themeMode: 'dark',
          margin: 2,
        format: 'hex',
        formatToggle: false,
        alpha: false,
        selectInput: true,
        formatToggle: true,
        });
      });
</script><?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/form/color.blade.php ENDPATH**/ ?>