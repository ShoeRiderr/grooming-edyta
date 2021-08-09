<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'   => ['required'],
            'content' => ['required'],

            'image.*.file'        => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
            'image.*.description' => ['nullable'],
            'image.*.name'        => ['required'],
        ];
    }
}
