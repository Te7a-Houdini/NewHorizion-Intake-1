<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\StoreProductRequest;
use Storage;
use Mail;
use App\Mail\ProductDestroyedMail;

class ProductController extends Controller
{
    public function index ()
    {
        $products = Product::get();

        return view('products.index')
        ->with('products',$products);
    }
    
    public function create()
    {
        return view('products.create');
    }

    public function store (StoreProductRequest $request)
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
            'image' => $path
        ]);

      return redirect()->route('products.index');
    }

    public function destroy($productId,Request $request)
    {

        Mail::to($request->user())->send(new ProductDestroyedMail);

        // $product = Product::find($productId);
        // Storage::disk('public')->delete($product->image);
        // $product->delete();
        // // Product::where('id',$productId)->delete();
        
        return redirect()->route('products.index');
    }
}
