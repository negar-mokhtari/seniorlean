<?php

namespace App\Http\Requests\Admin\Course;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required_if:money_status,money',
            'image' => 'required|mimes:jpg,jpeg,png,bmp,tiff',
            'video' => 'nullable|mimes:flv,mp4,m3u8,ts,3gp,mov,avi,wmv',
        ];
    }
}
