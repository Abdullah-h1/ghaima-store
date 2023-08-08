<?php

namespace App\Http\Controllers;

use App\Models\Addresses;
use App\Models\Customers;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    //
    public function getAddr(){
        try {

            
            $user = auth()->user();

            $Address = Addresses::where('customer_id', $user->id)->get();
            

            return json_encode($Address);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }

        // $Address = Addresses::where('customer_id', $id)->get();
        
        // return json_decode($Address);
    }
    public function submitAddr(Request $request){

        try {
            if(auth()->user()){
                $user = auth()->user();

                $address_type = 'false';

                if($request->address_type == 'true'){
                    Addresses::where('customer_id', $user->id)->update([
                        'address_type' => 'false',
                    ]);

                    $address_type = 'true';
                }

                Addresses::updateOrCreate(
                    [
                        'id' => $request->id,
                    ],
                    [
                    'address_type'=> $address_type,
                    'address'=> $request->address,
                    'latitude'=> $request->latitude,
                    'longitude'=> $request->longitude,
                    'customer_id'=> $user->id,
                    'contact_customer_number'=> $request->contact_customer_number,
                    'contact_customer_name'=> $request->contact_customer_name,
                    
                ]);


            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthenticated Error',
                ]);
            }
            

            return response()->json([
                'status' => true,
                'message' => 'Shipping Address Added Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                // 'message' => 'Unauthenticated Error',
            ], 500);
        }

    }

    public function defaultAddress(Request $request)
    {
        try {
            $user = auth()->user();

            Addresses::where('customer_id', $user->id)->update([
                'address_type' => 'false',
            ]);
            
            Addresses::where('id', $request->id)->update([
                'address_type' => 'true',
            ]);

            $Address = Addresses::where('customer_id', $user->id)->get();

            return json_encode($Address);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function deleteAddress($id)
    {
        try {
            $row = Addresses::where('id', $id);
            if($row){
                $row->delete();

                $user = auth()->user();
                $Address = Addresses::where('customer_id', $user->id)->get();

                return json_encode($Address);
            }

            return response()->json([
                'status' => false,
                'message' => 'validation error',
            ], 401);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
