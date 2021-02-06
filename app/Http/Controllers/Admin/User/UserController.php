<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','asc')
                        ->get();
        return view('admin.users.index',compact('users'));
    }
    public function changeLevel($user_id , $is_admin)
    {
        if($is_admin == 0)
        {
            User::where('id',$user_id)->update([
                'is_admin' => 1
            ]);
        }
        if($is_admin == 1)
        {
            User::where('id',$user_id)->update([
                'is_admin' => 0
            ]);
        }
    }
}
