<?php

namespace App\Admin\Custom\CustomModals;

use Encore\Admin\Table\Displayers\AbstractDisplayer;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Storage;

class ImageModal extends AbstractDisplayer
{
    public function display($server = '', $width = 200, $height = 200)
    {
        // if ($this->value instanceof Arrayable) {
        //     $this->value = $this->value->toArray();
        // }

        // return collect((array) $this->value)->filter()->map(function ($path) use ($server, $width, $height) {
        //     if (url()->isValidUrl($path) || strpos($path, 'data:image') === 0) {
        //         $src = $path;
        //     } elseif ($server) {
        //         $src = rtrim($server, '/').'/'.ltrim($path, '/');
        //     } else {
        //         $src = Storage::disk(config('admin.upload.disk'))->url($path);
        //     }
        //     $image_url = 'http://127.0.0.1:8000/uploads';
        //     return $this->imageContent($src,$width,$height);
        // })->implode('&nbsp;');
        
        $src = Storage::disk(config('admin.upload.disk'))->url($this->value);
        // $src = "http://127.0.0.1:8000/uploads/$this->value";
        return $this->imageContent($src,$width,$height);
    }

    public function imageContent($src,$width,$height)
    {
        $image = "<img src='$src' style='max-width:{$width}px;max-height:{$height}px' class='img img-thumbnail ' data-toggle='modal' data-target='#exampleModalCenter'/>";
        $image .= "<div class='modal fade' id='exampleModalCenter' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
        <div class='modal-dialog modal-dialog-centered' role='document'>
          <div class='modal-content'>
            <div class='modal-body'>
                <img class=' w-100' src='$src'/>
              </div>
              
            </div>
          </div>
        </div>";

        return $image;
    }
}