<script>
    $.admin.initTable(<?php echo $__table; ?>);
</script>

<div class="card table-card card-<?php echo "info";?> card-outline">
    <?php if(isset($title)): ?>
    <div class="card-header">
        <h3 class="card-title"> <?php echo e($title, false); ?></h3>
    </div>
    <?php endif; ?>

    <?php if( $table->showTools() || $table->showExportBtn() || $table->showCreateBtn() ): ?>
    <div class="card-header">
        <div class="card-tools">
            <?php echo $table->renderColumnSelector(); ?>

            <?php echo $table->renderExportButton(); ?>

            <?php echo $table->renderCreateButton(); ?>

        </div>
        <?php if( $table->showTools() ): ?>
        <div class="float-left d-flex">
            <?php echo $table->renderHeaderTools(); ?>

        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php echo $table->renderFilter(); ?>


    <?php echo $table->renderHeader(); ?>


    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover table-table table-head-fixed" id="<?php echo e($table->tableID, false); ?>">
            <thead>
                <tr>
                    <?php $__currentLoopData = $table->visibleColumns(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th <?php echo $column->formatHtmlAttributes(); ?>><?php echo $column->getLabel(); ?><?php echo $column->renderHeader(); ?></th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            </thead>

            <?php if($table->hasQuickCreate()): ?>
                <?php echo $table->renderQuickCreate(); ?>

            <?php endif; ?>

            <tbody>

                <?php if($table->rows()->isEmpty()): ?>
                    <?php echo $__env->make('admin::table.empty-table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>

                <?php $__currentLoopData = $table->rows(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr <?php echo $row->getRowAttributes(); ?>>
                    <?php $__currentLoopData = $table->visibleColumnNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td <?php echo $row->getColumnAttributes($name); ?>>
                        <?php echo $row->column($name); ?>

                    </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>

            <?php echo $table->renderTotalRow(); ?>


        </table>

    </div>

    <?php echo $table->renderFooter(); ?>


    <div class="card-footer clearfix">
        <?php echo $table->paginator(); ?>

    </div>
    <!-- /.card-body -->
</div>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/table/table.blade.php ENDPATH**/ ?>