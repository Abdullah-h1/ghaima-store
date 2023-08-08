<script>
$('<?php echo e($selector, false); ?>').off('<?php echo e($event, false); ?>').on('<?php echo e($event, false); ?>', function() {
    var data = $(this).data();
    var $target = $(this);
    var url = $(this).attr('url') || '<?php echo e($url, false); ?>';
    Object.assign(data, <?php echo json_encode($parameters, 15, 512) ?>);
    <?php echo $action_script; ?>

    var options = {};
    Object.assign(options, <?php echo json_encode($options, 15, 512) ?>);
    options.preConfirm = function(input) {
        return new Promise(function(resolve, reject) {
            $.ajax({
                method: '<?php echo e($method, false); ?>',
                url: url,
                data: data
            }).done(function (data) {
                resolve(data);
            }).fail(function(request){
                reject(request);
            });
        });
    };

    $.admin.confirm(options).then(function(result) {
        if (typeof result.dismiss !== 'undefined') {
            return Promise.reject();
        }
        return [result.value, $target];
    }).then($.admin.action.then).catch($.admin.action.catch);
});
</script>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/actions/dialog.blade.php ENDPATH**/ ?>