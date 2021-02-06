<?php

namespace App\Http\Controllers\User\Cart;

use App\Helpers\Cart\Cart;
use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CartController extends Controller
{
//    public function cart()
//    {
//
//    }
    /**
     * @param Course $course
     * @return mixed
     */
    public function addToCart(Course $course)
    {
        if(! Cart::has($course)) {
            Cart::put(
                [
                    'quantity' => 1,
                    'price' => $course->price
                ],
                $course
            );
        }
        return Cart::all();

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteFromCart($id)
    {
        Cart::delete($id);

        return back();
    }
}
