<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AjaxinfoController extends Controller
{
    public function getCategories()
    {
        $categories = Category::all();
        return json_encode(array('data' => $categories));
    }
}
