<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
// use App\Http\Requests\StoreProductRequest;
use Storage;
use Mail;
use App\Mail\ProductDestroyedMail;
// use Log;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    public function index ()
    {
        \Log::info('htting products index method');

        //Eager Loading  https://laravel.com/docs/5.6/eloquent-relationships#eager-loading
        $products = Product::with('category')->get();

        return view('products.index')
        ->with('products',$products);
    }
    
    public function create()
    {
        return view('products.create');
    }

    public function store (\App\Http\Requests\StoreProductRequest $request)
    {
        // $request->validate([
        //     'name' => 'required|min:3',
        //     'category_id' => 'required',
        // ],[
        //     'name.required' => 'product name is required',
        //     'name.min' => 'the product name is too minimum'
        // ]);

        $name = $request->name;
        $categoryId = $request->category_id;
        $path = $request->image->store('avatars','public');
    
        Product::create([
            'name' => $name,
            'category_id' => $categoryId,
            'image' => $path,
            //'slug' =>  str_slug($name)
        ]);

      return redirect()->route('products.index');
    }

    public function destroy($productId,Request $request)
    {
      
        $product = Product::find($productId);
        $product->delete();

       // Mail::to($request->user())->send(new ProductDestroyedMail);
        // Storage::disk('public')->delete($product->image);
        // // Product::where('id',$productId)->delete();
        
        return redirect()->route('products.index');
    }

    public function show($id)
    {
        // try {
        //     throw new Exception('this is exception');
        // }
        // catch(Exception $e)
        // {
        //     return 'we have catched exception';
        // }
        // try
        // {

        //     $product = Product::findOrFail($id);
        // }
        // catch(ModelNotFoundException $e)
        // {
        //     return 'we have catched model not found';
        // }
        $product = Product::find($id);
        
        return view('products.show',[
            'product' => $product
        ]);
    }
}
