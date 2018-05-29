<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|min:3',
            'category_id' => 'required',
            'image' => 'required|image'
        ];
    }

    public function messages()
    {
        return [
            //    'name.required' => 'product name is required',
            //    'name.min' => 'the product name is too minimum'

           // 'name.required' => trans('messages.my-app-required',[],'ar')
        ];
    }
}
