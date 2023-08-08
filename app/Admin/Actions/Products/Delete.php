<?php

namespace App\Admin\Actions\Products;

use App\Models\Products;
use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;
use Encore\Admin\Actions\RowAction;
use Encore\Admin\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class Delete extends RowAction
{
    public $name = 'Delete';
    protected $selector = '.delete';

    public function handle(Products $products)
    {
        // $request ...
        
        $trans = [
            'failed'    => trans('admin.delete_failed'),
            'succeeded' => trans('admin.delete_succeeded'),
        ];
        try {
            $product = $products->img_url;
            $url = public_path('uploads/'.$product);
            
            if (file_exists($url)) {
                unlink($url);
            }
            $products->delete();
        } catch (\Exception $exception) {
            return $this->response()->error("{$trans['failed']} : {$exception->getMessage()}");
        }


        return $this->response()->success($trans['succeeded'])->refresh();
    }

    public function dialog()
    {
        $this->confirm('Are you sure to delete this row?');
    }
    
    // public function html()
    // {
    //     return <<<HTML
    //         <a class="btn btn-danger">DELETE</a>   
    //     HTML;
    // }

    // public function render()
    // {   
    //     return $this->html();
    // }
    
    
}