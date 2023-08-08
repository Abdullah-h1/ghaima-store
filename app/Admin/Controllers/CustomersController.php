<?php

namespace App\Admin\Controllers;

use App\Admin\Custom\profileCard;
use App\Models\Customers;
use Carbon\Carbon;
use Encore\Admin\Form;
use Encore\Admin\Http\Controllers\AdminController;
use Encore\Admin\Show;
use Encore\Admin\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class CustomersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Customers';

    /**
     * Make a table builder.
     *
     * @return Table
     */
    protected function table()
    {
        $table = new Table(new Customers());

        // $table->column('id', __('Id'));
        
        $table->column('avatar', __('Avatar'))->display(function(){
            $src = URL::to('/uploads') . $this['avatar'];
            $image_url = 'http://127.0.0.1:8000/uploads' . $this['avatar'];
            return "<img src='$src' class='rounded-circle shadow-lg' style='width: 50px;'/>";
        });
        $table->column('name', __('User name'));
        $table->column('email', __('User email'));
        $table->column('phone', __('Phone'));
        $table->column('status', __('Status'))->display(function(){
            $str = '';
            if($this['status']){
                $str = "<div class='badge badge-success p-2' style='background: #26d26e41;color:#26d24e;'>Active</div>";
            } else {
                $str = "<div class='badge p-2' style='background: #dc354541;color:#dc3545;'>Block</div>";
            }
            return $str;
        });
        // $table->column('active', __('Active'));
        
        // $table->addresses()->address();

        
        $table->column('created_at', __('Created at'))->formatDate(true);

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
        $show = new Show(Customers::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('User name'));
        $show->field('email', __('User email'));
        $show->field('phone', __('Phone'));
        $show->field('avatar', __('Avatar'))->image();
        $show->field('status', __('Status'))->unescape()->as(function(){
            
            if($this['status']){
                return ' 
                        <div class="badge badge-success p-2" style="background: #26d26e41;color:#26d24e;">Active</div>';
            } else {
                return "<div class='badge p-2' style='background: #dc354541;color:#dc3545;'>Block</div>";
            }
            
        });
        $show->field('created_at', __('Created at'))->unescape()->as(function($val){
            
            return Carbon::parse($val)->format('F d, Y g:i A');
            
        });
        

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Customers());

        $form->text('name', __('User name'));
        $form->email('email', __('User email'));
        $form->mobile('phone', __('Phone'));
        $form->image('avatar', __('Avatar'));
        $form->switch('status', __('Status'))->default(0);
        $form->switch('active', __('Active'))->default(1);

        return $form;
    }
}
