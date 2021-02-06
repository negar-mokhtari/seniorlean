<?php

namespace App\Http\Controllers\Admin\Slider;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SortableController extends Controller
{
    public function updatePrioritySliders(Request $request)
    {
        $sliders = Slider::all();

        foreach ($sliders as $slider) {
            $slider->timestamps = false; // To disable update_at field updation
            $id = $slider->id;

            foreach ($request->priority as $priority) {
                if ($priority['id'] == $id) {
                    $slider->update(['priority' => $priority['position']]);
                }
            }
        }
        return response('Update Successfully.', 200);
    }
}
