<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>
                        <?php echo $header ?: admin_trans('admin.title'); ?>

                        <small><?php echo $description ?: admin_trans('admin.description'); ?></small>
                    </h4>
                </div>
                <div class="col-sm-6">
                    <?php if($breadcrumb): ?>
                    <ol class="breadcrumb float-sm-right mr-4">
                        <li class="breadcrumb-item"><a href="<?php echo e(admin_url('/'), false); ?>"><i class="fa fa-dashboard"></i> <?php echo e(__('Home'), false); ?></a></li>
                        <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($loop->last): ?>
                                <li class="active breadcrumb-item">
                                    <?php if(\Illuminate\Support\Arr::has($item, 'icon')): ?>
                                        <i class="fa fa-<?php echo e($item['icon'], false); ?>"></i>
                                    <?php endif; ?>
                                    <?php echo e($item['text'], false); ?>

                                </li>
                            <?php else: ?>
                                <li class="breadcrumb-item">
                                    <?php if(\Illuminate\Support\Arr::has($item, 'url')): ?>
                                        <a href="<?php echo e(admin_url(\Illuminate\Support\Arr::get($item, 'url')), false); ?>">
                                            <?php if(\Illuminate\Support\Arr::has($item, 'icon')): ?>
                                                <i class="fa fa-<?php echo e($item['icon'], false); ?>"></i>
                                            <?php endif; ?>
                                            <?php echo e($item['text'], false); ?>

                                        </a>
                                    <?php else: ?>
                                        <?php if(\Illuminate\Support\Arr::has($item, 'icon')): ?>
                                            <i class="fa fa-<?php echo e($item['icon'], false); ?>"></i>
                                        <?php endif; ?>
                                        <?php echo e($item['text'], false); ?>

                                    <?php endif; ?>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                    <?php elseif(config('admin.enable_default_breadcrumb')): ?>
                    <ol class="breadcrumb float-sm-right mr-4" >
                        <li class="breadcrumb-item"><a href="<?php echo e(admin_url('/'), false); ?>"><i class="fa fa-dashboard"></i> <?php echo e(__('Home'), false); ?></a></li>
                        <?php for($i = 2; $i <= count(Request::segments()); $i++): ?>
                            <li class="breadcrumb-item">
                                <?php echo e(ucfirst(Request::segment($i)), false); ?>

                            </li>
                        <?php endfor; ?>
                    </ol>
                    <?php endif; ?>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content" id="app">
        <div class="container-fluid">

        <?php echo $__env->make('admin::partials.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin::partials.exception', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin::partials.toastr', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php if($__view): ?>
            <?php echo $__env->make($__view['view'], $__view['data'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php else: ?>
            <?php echo $__content; ?>

        <?php endif; ?>
        </div>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::index', ['header' => strip_tags($header)], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/content.blade.php ENDPATH**/ ?>