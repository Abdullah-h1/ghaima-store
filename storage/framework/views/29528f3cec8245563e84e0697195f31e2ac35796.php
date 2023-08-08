<span data-toggle="modal" data-target="#table-modal-<?php echo e($name, false); ?>" data-key="<?php echo e($key, false); ?>">
   <a href="javascript:void(0)"><i class="fa fa-clone"></i>&nbsp;&nbsp;<?php echo e($value, false); ?></a>
</span>

<div class="modal table-modal fade <?php echo e($mark, false); ?>" id="table-modal-<?php echo e($name, false); ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 5px;">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e($title, false); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php echo $html; ?>

            </div>
        </div>
    </div>
</div>

<?php if($table): ?>
<style>
    .card.table-card {
        box-shadow: none;
        border-top: none;
    }

    .table-card .card-header:first-child {
        display: none;
    }
</style>
<?php endif; ?>

<?php if($async): ?>
<script>
    var modal = $('.<?php echo e($mark, false); ?>');
    var modalBody = modal.find('.modal-body');

    var load = function (url) {
        $.get(url, function (data) {
            modalBody.html(data);
        });
    };

    modal.on('show.bs.modal', function (e) {
        var key = $(e.relatedTarget).data('key');
        load('<?php echo e($url, false); ?>'+'&key='+key);
    }).on('click', '.page-item a, .filter-box a', function (e) {
        load($(this).attr('href'));
        e.preventDefault();
    }).on('submit', '.card-header form', function (e) {
        load($(this).attr('action')+'&'+$(this).serialize());
        return false;
    });
</script>
<?php endif; ?>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/table/display/modal.blade.php ENDPATH**/ ?>