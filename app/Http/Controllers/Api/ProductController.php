<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Http\Resources\ProductResource;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $paginatedProducts =  Product::paginate();

        //Eloquent APi Resource https://laravel.com/docs/5.6/eloquent-resources
        return ProductResource::collection($paginatedProducts);
    }

    public function store(StoreProductRequest $request)
    {
        //this logic is the same as web ProductController logic
        $name = $request->name;
        $categoryId = $request->category_id;
        $path = $request->image->store('avatars','public');
    
       $product =  Product::create([
            'name' => $name,
            'category_id' => $categoryId,
            'image' => $path,
            //'slug' =>  str_slug($name)
        ]);

        //Eloquent Api Resource https://laravel.com/docs/5.6/eloquent-resources#resource-responses
        return new ProductResource($product);
    }
}
