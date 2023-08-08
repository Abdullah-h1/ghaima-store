<?php

namespace App\Admin\Custom;

use Carbon\Carbon;
use Encore\Admin\Table\Displayers\AbstractDisplayer;

class CustomDateTime extends AbstractDisplayer{
    public function display($time = false)
    {
        $carbon = Carbon::parse($this->value);
        if (!$time){
            $carbon = $carbon->format('F d, Y g:i A');
        } else{
            $carbon = $carbon->format('F d, Y');
        }
        return '<span style="font-size: 12px;">' . $carbon. '</span>';
    }
}