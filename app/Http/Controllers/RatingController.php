<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    //
    public function submitRating(Request $request){
        $rating = new Rating();
        $rating->customer_id = $request->post("customer_id");
        $rating->product_id = $request->post("product_id");
        $rating->rating_value = $request->post("rating_value");

        if($rating->save()){
            return response()->json([
                'code' => 0,
                'msg' => 'Success'
            ]);
        }
        return response()->json([
            'code' => 0,
            'msg' => 'Fail'
        ]);
    }
}
