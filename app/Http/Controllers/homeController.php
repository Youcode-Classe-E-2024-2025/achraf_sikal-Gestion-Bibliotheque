<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index(Request $request){
        $featured = Book::limit(3)->get();
        return view('home',compact('featured'));
    }
}
