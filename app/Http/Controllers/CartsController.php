<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Products;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    public function index()
    {
        try {
            
            if(auth()->user()){
                $user = auth()->user();
                // $cart = Carts::where('customer_id', $user->id)->get();
                $carts = Carts::where('customer_id', $user->id)->with('products')->with('products.categories')
                ->with(['products.rating' => function ($query) {
                        $query->selectRaw('AVG(rating_value) as rating_value, product_id')
                              ->groupBy('product_id');
                    }])->with('products.colors')
                    ->with('products.sizes')
                    ->with('products.galleries')->get();
                
                    $carts = $carts->map(function ($cart) {
                        if(optional($cart->products->rating)->isEmpty()){
                            $ratingValue = 0.0;
                        } else{
        
                            $ratingValue = optional($cart->products->rating)->first()->rating_value;
                        }
                        $cart->products->rating_value = $ratingValue;
                        
                        return $cart;
                    });
                
            }
            
            return response()->json([
                'status' => true,
                'carts' => $carts,
                // 'product' => $product,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
    
    public function addToCart(Request $request)
    {
        try {
            
            if(auth()->user()){
                $user = auth()->user();

                Carts::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                    'customer_id' => $user->id,
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                    'product_size' => $request->product_size,
                    'product_color' => $request->product_color,
                    'price' => $request->price,
                ]);

            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthenticated Error',
                ]);
            }
            

            return response()->json([
                'status' => true,
                'message' => 'Cart Added Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                // 'message' => 'Unauthenticated Error',
            ], 500);
        }
    }

    public function setQuantity(Request $request, $id)
    {
        try {
            $quantity = 1;
            if(auth()->user()){
               $cart = Carts::findOrFail($id);
               $product = Products::findOrFail($cart->product_id);
                $quantity += $cart->quantity;
                $price = $product->price * $quantity;
                Carts::where('id', $id)->update([
                    'quantity' => $quantity,
                    'price' => $price,
                ]);
                
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthenticated Error',
                ]);
            }
            
            return response()->json([
                'status' => true,
                'message' => 'Cart Quantity Added Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                // 'message' => 'Unauthenticated Error',
            ], 500);
        }
    }
    
    public function reduceQuantity(Request $request, $id)
    {
        try {
            if(auth()->user()){
               $cart = Carts::findOrFail($id);
                $quantity = $cart->quantity - 1;
                if($quantity > 0){
                    $product = Products::findOrFail($cart->product_id);
                    $price = $product->price * $quantity;
                    Carts::where('id', $id)->update([
                        'quantity' => $quantity,
                        'price' => $price,
                    ]);
                } else {
                    Carts::where('id', $id)->delete();
                }
                
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthenticated Error',
                ]);
            }
            
            return response()->json([
                'status' => true,
                'message' => 'Cart Quantity reduced Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                // 'message' => 'Unauthenticated Error',
            ], 500);
        }
    }

    public function deleteCart(Request $request, $id)
    {
        try {
            if(auth()->user()){
               $cart = Carts::findOrFail($id);
                
                $cart->delete();
                // Carts::where('id', $id)->delete();
                
                
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthenticated Error',
                ]);
            }
            
            return response()->json([
                'status' => true,
                'message' => 'Cart Deleted Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                // 'message' => 'Unauthenticated Error',
            ], 500);
        }
    }
}
