<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index($id)
    {
        try {
            // $users = Auth::user();
            $users = Customers::find($id);

            $product = Products::with('customers')->whereHas('customers', function ($query) use ($users) {
                $query->where('customers.id', '=', $users->id);
            })->with(['rating' => function ($query) {
                $query->selectRaw('AVG(rating_value) as rating_value, product_id')
                      ->groupBy('product_id');
            }])->with('categories')->with('colors')
            ->with('sizes')
            ->with('galleries')->get();

            $product = $product->map(function ($products) {
                if(optional($products->rating)->isEmpty()){
                    $ratingValue = 0.0;
                } else{
    
                    $ratingValue = optional($products->rating)->first()->rating_value;
                }
                $products->rating_value = $ratingValue;
                return $products;
            });
            return json_encode($product);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function addFavorite(Request $request)
    {
        try {
            $check = false;
            
                $favor = new Favorite();
                $favor->product_id = $request->post('product_id');
                $favor->customer_id = $request->post('customer_id');
                // $favor->customer_id = $request->user()->id;

                    if($favor->save()){
                        $check = true;
                        
                    }
               
                if ($check == true) {
                    return response()->json([
                        'code' => 0,
                        'msg' => 'Success'
                    ], 200);
                }
                return response()->json([
                    'code' => 1,
                    'msg' => 'Fail'
                ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function deleteRow($id)
{
    $row = Favorite::where('product_id', $id);

    if ($row) {
        $row->delete();
        return response()->json(['message' => 'Row deleted successfully.']);
    } else {
        return response()->json(['message' => 'Row not found.'], 404);
    }
}
}
