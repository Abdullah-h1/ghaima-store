<div <?php echo admin_attrs($group_attrs); ?>>

    <label for="<?php echo e($id, false); ?>" class="<?php echo e($viewClass['label'], false); ?> col-form-label"><?php echo e($label, false); ?></label>

    <div class="<?php echo e($viewClass['field'], false); ?>">
        <select class="form-control <?php echo e($class, false); ?>" style="width: 100%;" name="<?php echo e($name, false); ?>[]" multiple="multiple" data-placeholder="<?php echo e($placeholder, false); ?>" <?php echo $attributes; ?> >
            <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $select => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($select, false); ?>" <?php echo $optionDataAttributes ? $optionDataAttributes[$select] : ''; ?> <?php echo e(in_array($select, (array)$value) ?'selected':'', false); ?>><?php echo e($option, false); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <input type="hidden" name="<?php echo e($name, false); ?>[]" />

        <?php echo $__env->make('admin::form.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin::form.help-block', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>
</div>

<script require="select2" <?php
    $vars = get_defined_vars();
    echo "selector='{$vars['selector']}' nested='{$vars['nested']}'";
?>>

    $(this).select2(<?php echo json_encode($configs, 15, 512) ?>);

    <?php if(isset($load)): ?>
    $(this).off('change').on('change', function () {
        var target = $(this).closest('.fields-group').find(".<?php echo e($load['class'], false); ?>");
        $.get("<?php echo e($load['sourceUrl'], false); ?>",{q : this.value}, function (data) {
            target.find("option").remove();
            $(target).select2({
                placeholder: {id:'', text: '<?php echo e(admin_trans('admin.choose'), false); ?>'},
                allowClear: <?php echo e($strAllowClear, false); ?>,
                data: $.map(data, function (d) {
                    d.id = d.<?php echo e($idField, false); ?>;
                    d.text = d.<?php echo e($textField, false); ?>;
                    return d;
                })
            });
            if (target.data('value')) {
                $(target).val(target.data('value'));
            }
            $(target).trigger('change');
        });
            <?php endif; ?>

            <?php if(isset($loads)): ?>
        var fields = '<?php echo e($fieldsStr, false); ?>'.split('.');
        var urls = '<?php echo e($urlsStr, false); ?>'.split('^');

        var refreshOptions = function(url, target) {
            $.get(url).then(function(data) {
                target.find("option").remove();
                $(target).select2({
                    placeholder: {id:'', text: '<?php echo e(admin_trans('admin.choose'), false); ?>'},
                    allowClear: <?php echo e($strAllowClear, false); ?>,
                    data: $.map(data, function (d) {
                        d.id = d.<?php echo e($idField, false); ?>;
                        d.text = d.<?php echo e($textField, false); ?>;
                        return d;
                    })
                }).trigger('change');
            });
        };

        $(this).off('change').on('change' , function () {
            var _this = this;
            var promises = [];

            fields.forEach(function(field, index){
                var target = $(_this).closest('.fields-group').find('.' + fields[index]);
                promises.push(refreshOptions(urls[index] + "?q="+ _this.value, target));
            });
        });
        <?php endif; ?>

        <?php if(isset($remote)): ?>
        $.ajax(<?php echo json_encode($options, 15, 512) ?>).done(function(data) {
            $(this).select2({
                data: data,
                <?php echo e($configs, false); ?>

            });
            var value = $(this).data('value') + '';
            if (value) {
                $(this).select2('val', value.split(','));
            }
        });
        <?php endif; ?>

        <?php if(isset($ajax)): ?>
        $(this).select2({
                ajax: {
                    url: "<?php echo e($url, false); ?>",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term,
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;

                        return {
                            results: $.map(data.data, function (d) {
                                d.id = d.<?php echo e($idField, false); ?>;
                                d.text = d.<?php echo e($textField, false); ?>;
                                return d;
                            }),
                            pagination: {
                                more: data.next_page_url
                            }
                        };
                    },
                    cache: true
                },
            <?php echo e($configs, false); ?>,
            escapeMarkup: function (markup) {
            return markup;
        }
    });
    <?php endif; ?>

</script>


<?php if(isset($readonly)): ?>
    <script>
        //移除特定字段名称,增加MultipleSelect的修订
        //没有特定字段名可以使多个readonly的JS代码片段被Admin::script的array_unique精简代码
        $("form select").on("select2:opening", function (e) {
            if($(this).attr('readonly') || $(this).is(':hidden')){
                e.preventDefault();
            }
        });
        $('select').each(function(){
            if($(this).is('[readonly]')){
                var $formgroup = $(this).closest('.form-group');
                $formgroup.find('span.select2-selection__choice__remove').first().remove();
                $formgroup.find('li.select2-search').first().remove();
                $formgroup.find('span.select2-selection__clear').first().remove();
            }
        });
    </script>
<?php endif; ?>
<?php /**PATH D:\GhaimaStore\ghaima\vendor\encore\laravel-admin\src/../resources/views/form/multipleselect.blade.php ENDPATH**/ ?>