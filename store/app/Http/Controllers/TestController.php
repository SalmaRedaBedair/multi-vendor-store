<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $categories->load('products');
        return 'test';
    }
}
