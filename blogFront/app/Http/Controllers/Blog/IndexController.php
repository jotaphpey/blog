<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(){

        return view('blog.index');
    }

    public function add(){

        return view('blog.add');
    }
}
