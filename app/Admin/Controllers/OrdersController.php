<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Products\Delete;
use App\Models\Customers;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Products;
use Carbon\Carbon;
use Encore\Admin\Admin as AdminAdmin;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Http\Controllers\AdminController;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Table;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\HtmlString;

;

class OrdersController extends AdminController
{

    
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Orders';

    // ***************
    // public function index(Content $content)
    // {
    //     $content->header('Orders');
    //     $content->description('');
    //     $content->body($this->table());
        
        
    //     return $content;
    // }

    /**
     * Make a table builder.
     *
     * @return Table
     */
    protected function table()
    {
        $image_url = URL::to('/uploads');
        $table = new Table(new Orders());
        // $table->setActionClass(Grid\Displayers\DropdownActions::class);
        // $table->expandFilter();
        $table->filter(function($filter){

            // Remove the default id filter
            $filter->disableIdFilter();
        
            // Add a column filter
            // $filter->like('currency', 'currency');
            $filter->in('currency')->checkbox([
                'YER' => 'يمني',
                'SAR' => 'سعودي',
            ]);

            // $filter->in('gender')->checkbox([
            //     'm'    => 'Male',
            //     'f'    => 'Female',
            // ]);
          
        
        });
        
        $table->column('id', 'Order ID')->modal('Order Items', function ($model) use ($image_url) {
            
            $rows = "<div class='content'><div class='container'><div class='row'>";
            foreach($model->orderItems as $e){
                $rows .= '<div class="col-xs-12 col-sm-4 mb-2"><div class="h-100 card" >';
                
                foreach (products::where('id', $e['product_id'])->get() as $a) {
                    
                        $img = $image_url. '/' .$a['img_url'];
                        $rows .= "<img src='{$img}' class='img-card img-thumbnail' alt='...'>
                        <div class='card-content p-2'>
                          <h4 class='card-title'><p class='font-weight-bold'>{$a["product_name"]}</p>
                          <p >{$a["product_desc"]}</p></h4></div>";
                        
                          $rows .= "<ul class='list-group list-group-flush'>
                                        <li class='list-group-item'>{$a['unit']} {$a['price']}</li>";
                        $total = floatval($a['price']);
                                        
                }
                $rows .= "<li class='list-group-item'>Size: {$e['product_size']}</li>
                            <li class='list-group-item'>Color: {$e['product_color']}</li>
                            <li class='list-group-item'>Quantity: {$e["quantity"]}</li>
                        </ul>";  
                $total *=  $e["quantity"];
                $rows .= "<div class='card-body'>
                            <p class='card-link'>Total: {$total}</p>
                        </div>
                        </div></div>";   
            }
            $rows .= "</div></div></div>";
            // $rows = "<table class='table table-hover table-bordered table-responsive-lg'>";
            // $rows.= "<thead>
            //             <tr>
            //                 <th scope='col'>id</th>
            //                 <th scope='col'>Product Name</th>
            //                 <th scope='col'>Product Image</th>
            //                 <th scope='col'>Quantity</th>
            //                 <th scope='col'>Price</th>
            //                 <th scope='col'>Size</th>
            //                 <th scope='col'>Color</th>
            //             </tr>
            //         </thead>";
            // $rows .= "<tbody>";
            
            // foreach($model->orderItems as $e){
            //     $rows .= "<tr>";
            //     $rows .= "<td>{$e['id']}</td>";
            //     foreach (products::where('id', $e['product_id'])->get() as $a) {
            //         // if($a['id'] == $e['id']){
            //             $img = $image_url.$a['img_url'];
            //             $rows .= "<td>{$a['product_name']}</td>";
            //             $rows .= "<td><img style='height: 200px;' src='{$img}' class='img-thumbnail'></td>";
            //             $rows .= "<td>{$a['price']}</td>";
                        
            //         // }
            //     }
            //     $rows .= "<td>{$e['quantity']}</td>";
            //     $rows .= "<td>{$e['product_size']}</td>";
            //     $rows .= "<td>{$e['product_color']}</td>";
            //     $rows .= "<tr>";
            //     // $rows = $rows."<td style='background:red;'>{$e['id']}</td>";
            //     // array_push($aa, $rows);
            // }
            // $rows .= "</tbody>";
            
            
            return $rows;
            
        })->sortable();
        

        $table->column('customers.name', 'Customer Name')->modal('Customer',function ($customers){
            $image_url = 'http://127.0.0.1:8000/uploads';
            $aa = [];
            
            $rows = "<table class='table table-hover table-bordered table-responsive-lg'>";
            $rows.= "<thead>
                        <tr>
                            <th scope='col'>id</th>
                            <th scope='col'>Name</th>
                            <th scope='col'>Email</th>
                            <th scope='col'>Phone</th>
                            <th scope='col'>Avatar</th>
                        </tr>
                    </thead>";
            $rows .= "<tbody>";
            $rows .= "<tr>";
            $customer = $customers->customers;
                    $img = $image_url.$customer['avatar'];
                    $rows .= "<td>{$customer['id']}</td>";
                    $rows .= "<td>{$customer['name']}</td>";
                    $rows .= "<td>{$customer['email']}</td>";
                    $rows .= "<td>{$customer['phone']}</td>";
                    $rows .= "<td><img src='{$img}' class='img-thumbnail'></td>";
                    // return $customer;
                    
                
            
            $rows .= "</tr>";
            $rows .= "</tbody>";
            return $rows;
        });
        $table->column('total_price')->display(function(){
            return "<div class='font-weight-bold'>{$this['total_price']} <span class='text-danger'>{$this['currency']}</span></div>";
        });
        // $table->customers()->name('Customer Name');

        

        $table->column('order_status')->display(function(){
            $background = '#38ABBE41';
            $color = '#38ABBE';
            $status = $this['order_status'];
            if($status == 'PENDING'){
                $background = "#FF980041";
                $color = "#FF9800";
            } elseif ($status == 'RECEIVED') {
                $background = "#4CAF5041";
                $color = "#4CAF50";
            } elseif ($status == 'NEW') {
                $background = "#2C96f141";
                $color = "#2C96f1";
            }
            return "<div class='badge badge-success p-2' style='background: $background;color:$color;'>$status</div>";
        })->filter([
            'PENDING' => 'PENDING',
            'RECEIVED' => 'RECEIVED',
            'SHIPPING' => 'SHIPPING',
        ]);
        
        // $table->column('order_status', __('Order status'));
        $table->column('created_at', __('Created at'))->display(function ($value) {
            return Carbon::parse($value)->format('F d, Y g:i A');
        });
        // $table->addresses()->address();
        $table->column('addresses.address', 'Shipping Address')->modal('Shipping Address',function ($customers){
            // $image_url = 'http://127.0.0.1:8000/uploads';
            $aa = [];
            $customer = $customers->addresses;
            
                    $rows = "<iframe width='100%' height='300' src='https://maps.google.com/maps?q={$customer['latitude']},{$customer['longitude']}&output=embed'></iframe>";
            $rows .= "<table class='table table-hover table-bordered table-responsive-lg'>";
            $rows.= "<thead>
                        <tr>
                            <th scope='col'>id</th>
                            <th scope='col'>Address</th>
                            <th scope='col'>Latitude</th>
                            <th scope='col'>longitude</th>
                            <th scope='col'>Contact Name</th>
                            <th scope='col'>Contact Number</th>
                        </tr>
                    </thead>";
            $rows .= "<tbody>";
            $rows .= "<tr>";
            
                    $rows .= "<td>{$customer['id']}</td>";
                    $rows .= "<td>{$customer['address']}</td>";
                    $rows .= "<td>{$customer['latitude']}</td>";
                    $rows .= "<td>{$customer['longitude']}</td>";
                    $rows .= "<td>{$customer['contact_customer_name']}</td>";
                    $rows .= "<td>{$customer['contact_customer_number']}</td>";
                    // return $customer;
                    
                
            
            $rows .= "</tr>";
            $rows .= "</tbody>";
            return $rows;
        });

        
        $table->actions(function($actions){
            // $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
            // $actions->add(new Delete);
            //make a Delete btn in laravel $table
            // $actions->add( $this->prepareAction(""));
                // $actions->add('<button type="submit" name="_method" id=""  value="
                // DELETE" onclick="return confirm(\'Are you sure?\')"</button>');
                
        });
        
        // $table->column('Action')->display(function($actions){
        //     // $actions->row;

        //     // gets the current row primary key value
        //     $aa = $this->getKey();
        //     $currentUrl = URL::current();
            
        //     Admin::script();


        //     return new HtmlString('<a data-_key="'.$aa.'" href="javascript:void(0);" class="asdf dropdown-item" url="'.$currentUrl.'/'.$aa.'">Delete</a>
        //         <script>
        //         ;(function () {
        //             $(".asdf").off("click").on("click", function() {
        //                 console.log("gjfgjgfj");
        //                 var data = $(this).data();
        //                 var $target = $(this);
        //                 var url = $(this).attr("url") || "";
        //                 Object.assign(data, {"_model":"App_Models_Orders","_action":"Encore_Admin_Table_Actions_Delete"});
                        
        //                 var options = {};
        //                 Object.assign(options, {"title":"Are you sure to delete this item ?","text":"","icon":"question"});
        //                 options.preConfirm = function(input) {
        //                     return new Promise(function(resolve, reject) {
        //                         $.ajax({
        //                             method: "DELETE",
        //                             url: url,
        //                             data: data
        //                         }).done(function (data) {
        //                             resolve(data);
        //                         }).fail(function(request){
        //                             reject(request);
        //                         });
        //                     });
        //                 };
                    
        //                 $.admin.confirm(options).then(function(result) {
        //                     if (typeof result.dismiss !== "undefined") {
        //                         return Promise.reject();
        //                     }
        //                     return [result.value, $target];
        //                 }).then($.admin.action.then).catch($.admin.action.catch);
        //             });
        //             })();
        //             </script>
        //     ');
        // });

        // ;(function () {
        //     $('.table-row-action-64cae99469cac3140').off('click').on('click', function() {
        //         var data = $(this).data();
        //         var $target = $(this);
        //         var url = $(this).attr('url') || '';
        //         Object.assign(data, {"_model":"App_Models_Orders","_action":"Encore_Admin_Table_Actions_Delete"});
                
        //         var options = {};
        //         Object.assign(options, {"title":"Are you sure to delete this item ?","text":"","icon":"question"});
        //         options.preConfirm = function(input) {
        //             return new Promise(function(resolve, reject) {
        //                 $.ajax({
        //                     method: 'DELETE',
        //                     url: url,
        //                     data: data
        //                 }).done(function (data) {
        //                     resolve(data);
        //                 }).fail(function(request){
        //                     reject(request);
        //                 });
        //             });
        //         };
            
        //         $.admin.confirm(options).then(function(result) {
        //             if (typeof result.dismiss !== 'undefined') {
        //                 return Promise.reject();
        //             }
        //             return [result.value, $target];
        //         }).then($.admin.action.then).catch($.admin.action.catch);
        //     });
        //     })();

        $table->column('Actions')->display(function($actions){
            // $actions->row;

            // gets the current row primary key value
            $aa = $this->getKey();
            $currentUrl = URL::current();
            return "<a href='$currentUrl/$aa' class='btn btn-info'><i class='fa fa-eye'></i></a>";
        });
        
        $table->header(function ($query) {
            return 'الطلبات';
        });
        
        // Admin::style('');
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
        $image_url = 'http://127.0.0.1:8000/uploads/';
        $show = new Show(Orders::findOrFail($id));

        $show->panel()->tools(function ($tools) {
                $tools->disableEdit();
                $tools->disableList();
                $tools->disableDelete();
                // $tools->disableTools();
            });;
        $show->field('id', __('Id'));
        
        $show->field('total_price', __('Total price'));
        $show->field('order_status', __('Order status'));
        $show->field('created_at', __('Created at'));
        $show->divider();
        $show->divider();
        $show->divider();
        $show->field('address_id', __('Address id'));
        // $show->customers();
        $show->field('orderItems')->unescape()->as(function($orderItems) use ($image_url){
            $mod = '<table class="table table-dark table-responsive-lg">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Image</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Size</th>
                <th scope="col">Color</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">';
              
            
            foreach ($orderItems as $value){
                $mod .= "<tr>
                <th scope='row'>{$value['id']}</th>";
                foreach (products::where('id', $value['product_id'])->get() as $a) {
                    // if($a['id'] == $e['id']){
                        $img = $image_url.$a['img_url'];
                        $mod .= "<td>{$a['product_name']}</td>";
                        $mod .= "<td><img style='height: 200px;' src='{$img}' class='img-thumbnail'></td>";
                        $mod .= "<td>{$a['price']}</td>";
                        
                    // }
                }
                $mod .= "<td>{$value['quantity']}</td>";
                $mod .= "<td>{$value['product_size']}</td>";
                $mod .= "<td>{$value['product_color']}</td>";
                $mod .= "</tr>";
            }
            $mod .='</tbody>
            </table>';
            
            return $mod;
        });

        $show->field('addresses')->unescape()->as(function ($avatar) {

            return "<iframe title='Iframe Example' width='100%' height='300' src='https://maps.google.com/maps?q=".$avatar->latitude.",".$avatar->longitude."&output=embed'></iframe>";
            // return "$avatar->latitude $avatar->longitude";
       
       });
        $show->divider();
        $show->field('customer_id', __('Customer id'));
        $show->field('customers')->unescape()->as(function ($user) {
            $image_url = 'http://127.0.0.1:8000/uploads';
            $img = $image_url.$user['avatar'];
            $card = '<div class="page-content page-container w-100 h-100" id="page-content">
            <div class="padding">
                <div class="row container d-flex justify-content-center">
        <div class="col-xl-6 col-md-12">
                                                        <div class="card user-card-full">
                                                            <div class="row m-l-0 m-r-0">
                                                                <div class="col-sm-4 bg-c-lite-green user-profile bg-dark p-4">
                                                                    <div class="card-block text-center text-white">';
            $card .= "<div class='m-b-25'>
                                                                            <img src='{$img}' class='img-radius img-fluid rounded-circle' alt='User-Profile-Image'>
                                                                        </div>
                                                                      <h6 class='f-w-600 mt-4 mb-2'>{$user['name']}</h6>
                                                                        
                                                                        <i class=' mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16'></i>
                                                                    </div>
                                                                </div>";
            $card .='                                                      <div class="col-sm-8 p-4">
                                                                    <div class="card-block">
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <h5 class="m-b-10 f-w-600">Email</h5>';
             $card .="                                                                   <h6 class='text-muted f-w-400'>{$user['email']}</h6>
                                                                            </div>
                                                                            <div class='col-sm-6'>
                                                                                <h5 class='m-b-10 f-w-600'>Phone</h5>
                                                                                <h6 class='text-muted f-w-400'>{$user['phone']}</h6>
                                                                            </div>
                                                                        </div>";
            $card .='                                                            <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Projects</h6>
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <p class="m-b-10 f-w-600">Recent</p>
                                                                                <h6 class="text-muted f-w-400">Sam Disuja</h6>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <p class="m-b-10 f-w-600">Most Viewed</p>
                                                                                <h6 class="text-muted f-w-400">Dinoter husainm</h6>
                                                                            </div>
                                                                        </div>
                                                                        <ul class="social-link list-unstyled m-t-40 m-b-10">
                                                                            <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                                                            <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                                                            <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     </div>
                                                        </div>
                                                    </div>';
            return $card;
        });
        
        $show->panel()->tools(function (Show\Tools $tools) {
            $tools->disableEdit(true);
            $tools->disableList();
            $tools->disableDelete();
            // $tools->disableTools();
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
        $form = new Form(new Orders());
        $form->tools(function (Form\Tools $tools) {

            // Disable `List` btn.
            // $tools->disableList();
        
            // Disable `Delete` btn.
            $tools->disableDelete();
        
            // Disable `Veiw` btn.
            $tools->disableView();
        
            });
        $form->display('id', __('Order id'));
        $form->divider();
        $form->radioCard('order_status', __('Order Status'))->options( [
            'NEW' => 'NEW',
            'PENDING'  => 'PENDING',
            'SHIPPING' => 'SHIPPING',
            'RECEIVED'  => 'RECEIVED',
        ]);
        Admin::style('
            .bg-info{
                background: #8a53dc!important;
                // color: red!important;
            }
        ');
        $form->hidden('created_at');
        $form->hidden('updated_at');
        
        $form->saving(function (Form $form) {
            $currentDateTime = Carbon::now();

            $form->created_at = $currentDateTime;
            $form->updated_at = $currentDateTime;
        
        });
        // $form->select('order_status', __('Order status'))->options([1 => 'foo', 2 => 'bar', 'val' => $order_status]);
        // $form->decimal('total_price', __('Total price'));
        // $form->text('order_status', __('Order status'));
        // $form->number('address_id', __('Address id'));
        // $form->color();

        return $form;
    }

}
