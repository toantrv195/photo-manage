<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoRequest extends FormRequest
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
            'txtTitle' => 'required|unique:photos,title',
            'fImages' => 'required|mimes:jpeg,jpg,png|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'txtTitle.required' => 'Please Enter Title',
            'txtTitle.unique' => 'This title Photo Is Exist',
            'fImages.required' => 'Please Choose Image',
            'fImages.mimes' => 'Image File Is Not Formats jpeg, jpg, png .',
            'fImages.max' => 'This Image Too Large, Max size 1000',
        ];
    }
}
