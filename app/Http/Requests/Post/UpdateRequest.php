<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'date'    => ['required', 'date_format:Y-m-d'],
            'time'    => ['required', 'date_format:H:i'],
            'content' => ['required'],

            'image.*.file'        => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
            'image.*.description' => ['nullable'],
            'image.*.name'        => ['nullable'],
        ];
    }
}
