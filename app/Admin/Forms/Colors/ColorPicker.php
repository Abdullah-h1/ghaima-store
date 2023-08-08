<?php

namespace App\Admin\Forms\Colors;

// use Encore\Admin\Widgets\Form;

use App\Models\Colors;
use Carbon\Carbon;
use Encore\Admin\Admin;
use Encore\Admin\Form\Field;
use Encore\Admin\Form;
use Illuminate\Http\Request;



// class ColorPicker extends Form
// {
//     public function __construct($model = null)
//     {
//         parent::__construct($model);

//         // ...

//         $this->form->colorPicker('code', 'Color Picker Field');

//         // ...
//     }
// }

class ColorPicker extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        //dump($request->all());

        admin_success('Processed successfully.');

        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->text('name')->rules('required');
        $this->colorpicker('code')->placeholder('Pick a color')->rules('required');
        $this->hidden('created_at');
        $this->hidden('updated_at');
        
        $this->saving(function (Form $form) {
            $color = $form->code;
            $color = str_replace('#', '', $color);
            $form->code = $color;
            $currentDateTime = Carbon::now();
            $form->created_at = $currentDateTime;
            $form->updated_at = $currentDateTime;
        
        });
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        return [];
    }
    
}
ColorPicker::extend('colorpicker', ColorPickerField::class);

class ColorPickerField extends Field
{
   
    /**
     * @var string
     */
    protected $view = 'admin.colorpicker';
    // protected $view = 'admin::form.color';

    /**
     * Use `hex` format.
     *
     * @return $this
     */
    public function hex()
    {
        return $this->options(['format' => 'hex']);
    }


    public function render()
    {
        // Admin::style('\resources\css\coloris.min.css');
        // Admin::js('\resources\js\coloris.min.js');
        return view($this->getView(),$this->variables());
    }
    
}
