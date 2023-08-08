<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\CustomActions;
use App\Admin\Actions\Products\Delete;
use App\Models\Colors;
use App\Models\Products;
use App\Models\Sizes;
use App\Models\Categories;
use App\Models\Rating;
use Carbon\Carbon;
use Encore\Admin\Actions\RowAction;
use Encore\Admin\Form;
use Encore\Admin\Http\Controllers\AdminController;
use Encore\Admin\Show;
use Encore\Admin\Table;
use Illuminate\Support\Facades\URL;
use PhpParser\Node\Expr\Cast\Double;

class ProductssController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Products';

    /**
     * Make a table builder.
     *
     * @return Table
     */
    protected function table()
    {
        $table = new Table(new Products());

        $table->column('id', __('Id'));
        $table->column('product_name', __('Product name'));
        // $table->column('img_url', __('Img url'))->image('', 60, 60);
        $table->column('img_url', __('Img url'))->imageModal('', 60, 60);
        $table->column('product_desc', __('Product desc')); 
        $table->column('price', __('YER'))->display(function($value){
            return "<div class='text-nowrap font-weight-bold'>$value <span class='text-danger'>YER</span></div>";
        });
        $table->column('sar_price', __('SAR'))->display(function($value){
            return "<div class='text-nowrap font-weight-bold'>$value <span class='text-danger'>SAR</span></div>";
        });
        // $table->column('unit', __('Unit'));
        $table->colors()->display(function ($colors) {

            $colors = array_map(function ($color) {
                return "<span class='label label-success badge' style='background:#{$color['code']};width:100;'>&nbsp;&nbsp;</span>";
            }, $colors);
        
            return join('&nbsp;', $colors);
        });
        $table->sizes()->display(function ($sizes) {

            $sizes = array_map(function ($size) {
                return "<span class='label label-success'>{$size['size_name']}</span>";
            }, $sizes);
        
            return join('&nbsp;', $sizes);
        })->label();
        $table->categories()->display(function ($categories) {

            $categorie = array_map(function ($category) {
                return "<span class='label label-success'>{$category['name']}</span>";
            }, $categories);
        
            return join('&nbsp;', $categorie);
        })->label("danger");
        // $table->column('categories.category_name','Category');
        
        $table->rating()->display(function ($rating) {
            if (is_array($rating)) {
                $ratin = array_map(function ($rate) {
                    return $rate['rating_value'];
                }, $rating);
                $stars = '';
                $avg_rating = collect($ratin)->avg();
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $avg_rating) {
                        $stars .= '<i class="fa fa-star" style="color:orange;"></i>';
                    } elseif ($i - 0.5 == $avg_rating) {
                        $stars .= '<i class="fa fa-star-half-alt" style="color:orange;"></i>';
                    } else {
                        $stars .= '<i class="far fa-star" style="color:orange;"></i>';
                    }
                }
                return $stars;
            } else {
                return '';
            }
        });

        // $table->rating()->rating_value();
        $table->column('created_at', __('Created at'))->display(function ($value) {
            return Carbon::parse($value)->format('F d, Y g:i A');
        });
        // $table->column('updated_at', __('Updated at'));
        $table->setActionClass(Grid\Displayers\DropdownActions::class);
        $table->actions(function($actions){
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
            // $actions->add(new Delete);
        });
        // $table->column('Act')->editButton();
        $table->column('Actions')->display(function($value){
            $aaa = new CustomActions();
            return "
                <table>
                    <thead>
                        <tr>
                            <td>
                                {$aaa->showBtn($this->getKey())}
                            </td>
                            <td>
                            {$aaa->deleteBtn($this, $this->getKey())} 
                            </td>
                            <td>
                                {$aaa->editBtn($this->getKey())}
                            </td>
                        </tr>
                    </thead>
                </table>
            ";
        });
        
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
        $show = new Show(Products::findOrFail($id));

        // $show->field('id', __('Id'));
        $show->field('product_name', __('Product name'));
        $show->field('img_url', __('Img url'))->image();
        $show->field('product_desc', __('Product desc'));
        $show->field('price', __('Price'))->unescape()->as(function($value){
            return "<div class='d-flex justify-content-between font-weight-bold'>
                <span>$value</span>
                <span class='text-danger '>YER</span>
            </div>";
        });
        $show->field('sar_price', __('Sar Price'))->unescape()->as(function($value){
            
            return "<div class='d-flex justify-content-between font-weight-bold'>
                <span>$value</span>
                <span class='text-danger '>SAR</span>
            </div>";
        });
        // $show->field('discount_value', __('Discount value'));
        // $show->field('unit', __('Unit'));
        $show->field('created_at', __('Created at'))->unescape()->as(function($val){
            
            return Carbon::parse($val)->format('F d, Y g:i A');
            
        });
        // $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Products());

        $form->text("product_name", "Name");
        $form->textarea("product_desc", "Description");
        $form->image("img_url", "ImgUrl");
        $form->currency("price", "Yer Price");
        $form->currency("sar_price", "Sar Price");
        $form->number("discount_value", "Discount Value");
        // $form->select("unit","Unit")->options(['YER' => 'YER', '$' => '$']);
        $form->multipleSelect('colors','color')->options(Colors::all()->pluck('name','id'));
        $form->multipleSelect('categories','category')->options(Categories::all()->pluck('name','id'));
        $form->multipleSelect('sizes','size')->options(Sizes::all()->pluck('size_name','id'));
        // $form->multipleSelect('colors', 'Colors')->options(function ($ids) {
        //     $colors = Colors::all();
        //     $options = [];
        //     foreach ($colors as $color) {
        //         $options[$color->id] = $color->name;
        //     }
        //     return $options;
        // });
        // $form->checkbox('colors[]', 'color', Colors::all()->pluck('name', 'id')->toArray());
        // $form->checkbox('sizes','size')->options(Sizes::all()->pluck('size_name','id'));

        $form->hasMany('galleries', function (Form\NestedForm $form) {
            // $form->multipleImage('url', 'Images')->removable();
            $form->image('url', 'Image');
        });

        return $form;
    }
}
