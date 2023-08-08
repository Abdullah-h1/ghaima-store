
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.css"/>
<script src="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.js"></script> --}}
<link rel="stylesheet" href="{{ asset('css/coloris.min.css')}}"/>
<script src="../../../js/jquery/jquery.min.js"></script>
<script src="{{ asset('js/coloris.min.js')}}"></script>

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
            <input data-coloris id="my_color_picker" type="text" name="{{ $name }}" value="{{ old($column, $value) }}" class="form-control field-code" placeholder="{{ $placeholder }}">

            {{-- <input data-coloris id="my_color_picker" {!! $attributes !!} class="form-control field-code"/> --}}
            <button type="button" class="input-group-prepend">
                <span class="input-group-text" id="color_view">
                </span> 
             </button>
        </div>
        @include('admin::form.error')
        @include('admin::form.help-block')
    </div>
</div>

{{-- <script @script>
    $(this).parent().kendoColorPicker();
</script> --}}

<script>
    $(document).ready(function() {
        
        var val = $('#my_color_picker').val();
        var character = '#';

        if (val.indexOf(character) !== -1 || val == '') {
            console.log('The input value contains the character ' + character);
        } else {
            $('#my_color_picker').val('#' + $('#my_color_picker').val());
        console.log('The input value does not contain the character ' + character);
        }
        
        
    });


    
    $('#my_color_picker').on('click',function(){
        Coloris({
            // theme: 'default',
            // theme: 'large',
            // theme: 'pill',
            theme: 'polaroid',
            themeMode: 'dark',
            el: '#my_color_picker',
            margin: 2,
            format: 'hex',
            wrap: false,
            rtl: false,
            formatToggle: false,
            alpha: false,
            selectInput: true,
            // Set to true to hide all the color picker widgets (spectrum, hue, ...) except the swatches.
            swatchesOnly: false,
              // Show an optional clear button
            clearButton: true,
            // Show an optional close button
            closeButton: true,

            // Set the label of the close button
            closeLabel: 'Close',
            // An array of the desired color swatches to display. If omitted or the array is empty,
            // the color swatches will be disabled.
            swatches: [
                '#FFFFFF',
                '#000000',
                '#FF0000',
                '#008000',
                '#00FF00',
                '#0000FF',
                '#800080',
                '#FFFF00',
                '#008080',
                '#00FFFF',
                '#00ffff',
                '#ff1493',
            ],

            inline: false,
            defaultColor: '#900000',
            
            onChange: (color) => undefined 
        });
        // Coloris.close(true);
    });
</script>