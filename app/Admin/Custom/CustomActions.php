<?php

namespace App\Admin\Custom;

use Encore\Admin\Admin;
use Encore\Admin\Table\Displayers\AbstractDisplayer;
use Illuminate\Support\Facades\URL;

class CustomActions extends AbstractDisplayer
{
    public function display()
    {
        $aa = $this->getKey();
        $currentUrl = URL::current();
        $url = '$currentUrl/$aa';
        return <<<EOT
            <table style="border: none;">
                <thead>
                <tr>
                <td>
                    <a href='$currentUrl/$aa' class='btn btn-info'><i class='fa fa-eye'></i></a>
                </td>
                    <td>
                        <a href="javascript:void(0);" class="btn btn-sm btn-danger delete-record" title="Delete">
                            <i class="fa fa-trash"></i><span class="hidden-xs">  Delete</span>
                        </a>
                    
                    </td>
                    <td>
                        <a href="$currentUrl/$aa/edit" class="btn btn-secondary d-flex justify-content-md-between align-items-center">
                        Edit<i class="fa fa-edit ml-1"></i>
                        </a>
                    </td>
                </tr>
                </thead>
            </table> 
            <script data-exec-on-popstate="">
                                
                require(["admin"], function ($) {
                    
                    ;(function () {
                    $('.delete-record').off('click').on('click', function() {
                        var data = $(this).data();
                        
                        var url = $(this).attr('url') || '$url';
                        Object.assign(data, {"model":"App\\Models\\Colors","key":$aa,"path":"$currentUrl","_action":"Encore_Admin_Show_Actions_Delete"});
                        
                        var options = {};
                        Object.assign(options, {"title":"Are you sure to delete this item ?","text":"","icon":"question"});
                        options.preConfirm = function(input) {
                            return new Promise(function(resolve, reject) {
                                $.ajax({
                                    method: 'DELETE',
                                    url: url,
                                    data: data
                                }).done(function (data) {
                                    resolve(data);
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
                    });
                    })();
                });
                </script>
        EOT;
    }
}