<?php

namespace App\Admin\Actions;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Encore\Admin\Actions\Action;



class CustomActions
{
    
    public function deleteTableRows(Request $request)
    {
        $products = Products::find($request['id']);
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
            return response()->json([
                'fail' => "{$trans['failed']} : {$exception->getMessage()}",
            ]);
        }


          
        
        return response()->json([
            'success' => $trans['succeeded'],
            'data' => $request['id'],
        ]);
    }
    public function deleteBtn($model, $id)
    {
        $model = $model;
        
        $urls = URL::to('/');
        $url = "{$urls}/api/deleteTableRows";
        
        $btn = "<a href='javascript:void(0);' class='btn btn-sm btn-danger d-flex justify-content-md-between align-items-center' onclick='deleteRows({$model}, $id)'>
            <i class='fa fa-trash mr-1'></i>Delete    
        </a>";
        return <<<EOT
            
            {$btn}
            <script>
                function deleteRows(model, id) {
                    var data = model;
                    var options = {};
                    Object.assign(options, {"title":"Are you sure to delete this item ?","text":"","icon":"question"});
                    options.preConfirm = function(input) {
                        return new Promise(function(resolve, reject) {
                            $.ajax({
                                method: 'POST',
                                url: '{$url}',
                                data: data,
                                success: function(response) {
                                            console.log(response);
                                            
                                            $.admin.reload('Row Deleted successfully !');
                                        },
                                        error: function(xhr, status, error) {
                                            console.log('Error updating score: ' + error);
                                            $.admin.toastr.error(error);
                                        }
                            }).done(function (response) {
                                console.log("asadhaduihui");
                                resolve("response");
                            }).fail(function(request){
                                reject(request);
                            });
                        });
                    };

                    $.admin.confirm(options).then(function(result) {
                        if (typeof result.dismiss !== 'undefined') {
                            return Promise.reject();
                        }
                        return [result.value, $(this)];
                    }).then($.admin.action.then).catch($.admin.action.catch);
                    
                    
                }
            </script>
            EOT;
    }

    // $.admin.toastr.success('Row Deleted successfully !');
    // $.ajax({
    //     url: "{$url}/api/deleteTableRows/" + id,
    //     type: 'POST',
    //     success: function(response) {
    //         console.log('Score updated successfully');
    //     },
    //     error: function(xhr, status, error) {
    //         console.log('Error updating score: ' + error);
    //     }
    // });
    public function showBtn($id)
    {   
        $currentUrl = URL::current();
        $url = "$currentUrl/$id";
        return <<<EOT

                <a href="$url" class="btn btn-sm btn-info pl-2 pr-2"><i class="fa fa-eye"></i></a>
            EOT;
    }
    
    public function editBtn($id)
    {   
        $currentUrl = URL::current();
        $url = "$currentUrl/$id/edit";
        return <<<EOT

                <a href="$url" class="btn btn-sm btn-secondary d-flex justify-content-md-between align-items-center">
                    Edit<i class="fa fa-edit ml-1"></i>
                </a>
            EOT;
    }
    
}