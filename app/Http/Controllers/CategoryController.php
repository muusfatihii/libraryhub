<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    

    public function categories(){

        return view('categories', [
            'categories' => Category::all()
        ]);

    }
    

}
