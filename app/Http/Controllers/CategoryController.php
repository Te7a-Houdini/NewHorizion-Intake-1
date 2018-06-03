<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Cache;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
  
        // $categories = Category::paginate(2);
        $categories = Cache::remember('categories-cached'.$request->page, 10, function () {
            return  Category::paginate(2);
        });
        
        return view('categories.index')
            ->with('categories',$categories);
    }


  
}
