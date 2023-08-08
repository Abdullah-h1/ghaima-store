<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <?php if(config('admin.show_environment')): ?>
            <strong>Env</strong>&nbsp;&nbsp; <?php echo config('app.env'); ?>

        <?php endif; ?>
        <?php if(config('admin.show_version')): ?>
            <b>Version</b> <?php echo \Encore\Admin\Admin::VERSION; ?>

        <?php endif; ?>
    </div>
    <strong>Powered by <a href="https://github.com/z-song/laravel-admin" target="_blank">laravel-admin</a></strong>
</footer>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/partials/footer.blade.php ENDPATH**/ ?>