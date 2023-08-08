<?php if($errors->hasBag('exception') && config('app.debug') == true): ?>
    <?php $error = $errors->getBag('exception');?>
    <div class="callout callout-danger">
        <h5 class="text-danger">
            <i class="icon fas fa-exclamation-triangle"></i>
            <i style="border-bottom: 1px dotted #fff;cursor: pointer;" title="<?php echo e($error->first('type'), false); ?>" ondblclick="var f=this.innerHTML;this.innerHTML=this.title;this.title=f;"><?php echo e(class_basename($error->first('type')), false); ?></i>
            In <i title="<?php echo e($error->first('file'), false); ?> line <?php echo e($error->first('line'), false); ?>" style="border-bottom: 1px dotted #fff;cursor: pointer;" ondblclick="var f=this.innerHTML;this.innerHTML=this.title;this.title=f;"><?php echo e(basename($error->first('file')), false); ?> line <?php echo e($error->first('line'), false); ?></i> :
        </h5>

        <p><a style="cursor: pointer;" onclick="$('#laravel-admin-exception-trace').toggleClass('d-none');$('i', this).toggleClass('fa-angle-double-down fa-angle-double-up');"><i class="fa fa-angle-double-down"></i>&nbsp;&nbsp;<?php echo $error->first('message'); ?></a></p>

        <p class="d-none" id="laravel-admin-exception-trace"><br><?php echo nl2br($error->first('trace')); ?></p>
    </div>
<?php endif; ?>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/partials/exception.blade.php ENDPATH**/ ?>