<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Payments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrdersController extends Controller
{
    public function store(Request $request)
    {
        try {
            // $request = json_decode($request);
            
            if(auth()->user()){
                $user = auth()->user();
                $orders = Orders::create([
                    'address_id' => $request->shipping_address,
                    'customer_id' => $user->id,
                    'order_status' => $request->order_status,
                    'total_price' => $request->total_price,
                    'currency' => $request->currency,
                    'created_at' => $request->created_at,
                ]);

                foreach($request->carts as $cart){
                    OrderItems::create([
                        'order_id' => $orders->id,
                        'product_id' => $cart['product_id'],
                        'quantity' => $cart['quantity'],
                        'product_size' => $cart['product_size'],
                        'product_color' => $cart['product_color'],
                        'price' => $cart['price'],
                        'sar_price' => $cart['sar_price'],
                    ]);
                }

                
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthenticated Error',
                ]);
            }
            // echo(json_encode($request));
            return response()->json([
                'status' => true,
                'message' => 'Orders Added Successfully',
                
            ], 200); 
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);        
        }
    }

    public function show()
    {
        try {
            if(auth()->user()){
                $user = auth()->user();

                // $orders = Orders::findOrFail($user->id);
                $orders = Orders::where('customer_id', $user->id)->with('addresses')->with('payments')->get();
                $orders = $orders->map(function($order){
                    $order->order_items = $this->getOrderItems($order->id);

                    return $order;
                });
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthenticated Error',
                ]);
            }
            return json_encode($orders);
            // return json_encode($this->getOrderItems($orders->id));
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500); 
        }
    }

    private function getOrderItems($id)
    {
        $orderItems = OrderItems::where('order_id', $id)->with('products')->with('products.categories')
        ->with(['products.rating' => function ($query) {
                $query->selectRaw('AVG(rating_value) as rating_value, product_id')
                      ->groupBy('product_id');
            }])->with('products.colors')
            ->with('products.sizes')
            ->with('products.galleries')->get();
        
            $orderItems = $orderItems->map(function ($orderItem) {
                if(optional($orderItem->products->rating)->isEmpty()){
                    $ratingValue = 0.0;
                } else{

                    $ratingValue = optional($orderItem->products->rating)->first()->rating_value;
                }
                $orderItem->products->rating_value = $ratingValue;
                
                return $orderItem;
            });

            return $orderItems;

    }

    public function receiveOrder(Request $request)
    {
        try {
            if(auth()->user()){
                $id = $request->id;
                $order = Orders::findOrFail($id);
                $order->update([
                    'order_status' => 'RECEIVED',
                ]);

            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthenticated Error',
                ]);
            }
            
            return response()->json([
                'status' => true,
                'message' => 'Order Status Updated Successfully',
            ], 200); 
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500); 
        }
    }

    public function setPayments(Request $request)
    {
        try {
            if (auth()->user()) {
                if ($request->has('image')){
                    $dir="payments/";
    
                    $image = $request->file('image');
                    
                    $imageName = \Carbon\Carbon::now()->toDateString() . "-" . uniqid() . "." . "png";
                    if (!Storage::disk('admin')->exists($dir)) {
                        Storage::disk('admin')->makeDirectory($dir);
                    }
                    Storage::disk('admin')->put($dir.$imageName, file_get_contents($image));
        
                    $createdAt = Carbon::createFromFormat('Y-n-j G:i:s', $request->created_at);
                    $totalPrice = doubleval($request->total_price);

                    $paymentsJson = [];
                    $paymentsJson['prove_img'] = trans('/'.$dir.$imageName);
                    $orders = Orders::get()->last();
                    $paymentsJson['order_id'] = $orders->id;
                    $paymentsJson['method'] = $request->method;
                    $paymentsJson['amount'] = $totalPrice;
                    $paymentsJson['created_at'] = $createdAt;

                    Payments::create($paymentsJson);
                }
                
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthenticated Error',
                ]);
            }

            
            // Payments::create($paymentsJson);
            return response()->json([
                'status' => true,
                'message' => 'Payments Added Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500); 
        }
    }
}
