<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\CustomActions;
use App\Admin\Custom\CustomActions as CustomCustomActions;
use App\Admin\Forms\Colors\ColorPicker;
use App\Admin\Forms\Colors\ColorPickerField;
use App\Models\Colors;
use Carbon\Carbon;
use Encore\Admin\Admin;
use Encore\Admin\Form;
use Encore\Admin\Http\Controllers\AdminController;
use Encore\Admin\Show;
use Encore\Admin\Table;

class ColorsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Colors';

    /**
     * Make a table builder.
     *
     * @return Table
     */
    protected function table()
    {
        $table = new Table(new Colors());

        $table->column('id', __('Id'));
        $table->column('name', __('Name'));
        $table->column('code', __('color'))->display(function ($colors) {
            return "<span class='label label-success badge' style='background:#{$colors};width:200;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>";
        });
        $table->column('created_at', __('Created at'))->display(function ($value) {
            return Carbon::parse($value)->format('F d, Y g:i A');
        });
        // $table->column('created_at', __('Created at'));
        // $table->column('updated_at', __('Updated at'));

        $table->quickCreate(function (Table\Tools\QuickCreate $create) {
            $create->text('name', 'Name')->required();
            $create->text('code', 'Code')->required();
            // $create->colorpicker('code')->default('#FF0000')->placeholder('Pick a color')->rules('required');
        });

        // $table->disableActions();
        
        // $table->column('Act')->editButton();
        
        
        return $table;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Colors::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('code', __('Code'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        // Form::extend('colorpicker', \App\Admin\Forms\Colors\ColorPickerField::class);
        // $form = new Form(new Colors());
        // // $form->method('get');
        // $form->text('name', __('Name'));
        // // $form->color('code', 'Code');
        // $form->colorpicker('code', 'Code');
        // $form->field('code','Code');
        // $form->text('code', __('Code'));
        // return $form;
        $form = new ColorPicker(new Colors());
        $form->form();

        return $form;
    }
    
    
}
// ColorPicker::extend('colorpicker', ColorPickerField::class);
