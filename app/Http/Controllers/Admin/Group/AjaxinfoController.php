<?php

namespace App\Http\Controllers\Admin\Group;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;

class AjaxinfoController extends Controller
{
    public function getGroups()
    {
        $groups = Group::all();
        return json_encode(array('data' => $groups));
    }
}
