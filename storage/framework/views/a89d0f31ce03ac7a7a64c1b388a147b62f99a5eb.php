<script>
$('<?php echo e($selector, false); ?>').off('<?php echo e($event, false); ?>').on('<?php echo e($event, false); ?>', function() {
    var data = $(this).data();
    var $target = $(this);
    var url = $(this).attr('url') || '<?php echo e($url, false); ?>';
    Object.assign(data, <?php echo json_encode($parameters, 15, 512) ?>);
    <?php echo $action_script; ?>

    new Promise(function (resolve,reject) {
        $.ajax({
            method: '<?php echo e($method, false); ?>',
            url: url,
            data: data
        }).done(function (data) {
            resolve([data, $target]);
        }).fail(function(request){
            reject(request);
        });
    }).then($.admin.action.then).catch($.admin.action.catch);
});
</script>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/actions/action.blade.php ENDPATH**/ ?>