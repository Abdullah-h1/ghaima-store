<link href="../../../css/bootstrap/bootstrap-colorpicker.min.css" rel="stylesheet">
<script src="../../../js/jquery/jquery.min.js"></script>
{{-- <script src="../../../js/bootstrap/bootstrap.min.js"></script> --}}
<script src="../../../js/bootstrap/bootstrap-colorpicker.js"></script>

<div {!! admin_attrs($group_attrs) !!}>
    <label for="{{$id}}" class="{{$viewClass['label']}} col-form-label">{{$label}}</label>
    <div class="{{$viewClass['field']}}">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-palette fa-fw"></i>
                </span>
            </div>
            {{-- <input id="my_color_picker" type="text" name="{{ $name }}" value="{{ old($column, $value) }}" class="form-control field-code" placeholder="{{ $placeholder }}"> --}}
            <input id="my_color_picker" type="text" name="{{ $name }}" value="{{ old($column, $value) }}" class="form-control field-code" placeholder="{{ $placeholder }}">

            {{-- <input data-coloris id="my_color_picker" {!! $attributes !!} class="form-control field-code"/> --}}
            {{-- <div class="input-group-prepend">
                <span class="input-group-text" id="color_view">
                </span> 
             </div> --}}
        </div>
        @include('admin::form.error')
        @include('admin::form.help-block')
    </div>
</div>

<script>
    $(document).ready(function() {
        console.log('sadadad');
        $('#my_color_picker').colorpicker();
        
        
    });
    	
        
    
</script>