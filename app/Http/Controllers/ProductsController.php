<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Rating;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
    public function index(){
        try {
            //code...
            // $product = Products::leftJoin('rating', 'products.id', '=', 'rating.product_id')
            // ->selectRaw('products.*, AVG(rating.rating_value) as rating_value')
            // ->groupBy('products.id')
            // ->get();
            $product = Products::with(['rating' => function ($query) {
                $query->selectRaw('AVG(rating_value) as rating_value, product_id')
                      ->groupBy('product_id');
            }])->with('galleries')->with('categories')
            ->with('colors')
            ->with('sizes')->get();
            // (CASE WHEN (AVG(rating_value) = 0) THEN 0 ELSE AVG(rating_value) END)
            $product = $product->map(function ($products) {
                // printf('sklajdkakdlj555555555');
                if(optional($products->rating)->isEmpty()){
                    $ratingValue = 0.0;
                } else{

                    $ratingValue = optional($products->rating)->first()->rating_value;
                }
                $products->rating_value = $ratingValue;
                $products->category_name = optional($products->categories)->first()->name;
                $colorNames = $products->colors->pluck('name')->toArray(); // Get an array of color names
                $products->color_names = $colorNames;
                
                $sizeNames = $products->sizes->pluck('size_name')->toArray(); // Get an array of color names
                $products->size_names = $sizeNames;
                return $products;
            });
            return json_encode($product);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
       try {
        
        $product = Products::where('id', '=', $id)->with(['rating' => function ($query) {
            $query->selectRaw('AVG(rating_value) as rating_value, product_id')
                  ->groupBy('product_id');
        }])->with('categories')
        ->with('colors')
        ->with('sizes')
        ->with('galleries')->get();
        // (CASE WHEN (AVG(rating_value) = 0) THEN 0 ELSE AVG(rating_value) END)
        $product = $product->map(function ($products) {
            // printf('sklajdkakdlj555555555');
            if(optional($products->rating)->isEmpty()){
                $ratingValue = 0.0;
            } else{

                $ratingValue = optional($products->rating)->first()->rating_value;
            }
            $products->rating_value = $ratingValue;
            $products->category_name = optional($products->categories)->first()->name;
            $colorNames = $products->colors->pluck('name')->toArray(); // Get an array of color names
            $products->color_names = $colorNames;
            
            $sizeNames = $products->sizes->pluck('size_name')->toArray(); // Get an array of color names
            $products->size_names = $sizeNames;

            $galleryUrl = $products->galleries->first()->url;
            $products->gallery = $galleryUrl;
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

    public function productsCate()
    {
        try {
            $category = Categories::all('id', 'name', 'img_url');

            return json_encode($category);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function categoryFilter($id)
    {
        try {
            
            $category = Categories::find($id);

            $product = Products::with('categories')->whereHas('categories', function ($query) use ($category) {
                $query->where('id', '=', $category->id);
            })->with(['rating' => function ($query) {
                $query->selectRaw('AVG(rating_value) as rating_value, product_id')
                      ->groupBy('product_id');
            }])->with('colors')
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
}
