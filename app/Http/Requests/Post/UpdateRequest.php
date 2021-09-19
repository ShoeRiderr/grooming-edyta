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
            'title'   => ['nullable'],
            'content' => ['nullable'],
            'description' => ['nullable'],
            'date'    => ['required', 'date_format:Y-m-d'],
            'time'    => ['required', 'date_format:H:i'],

            'image' => ['nullable', 'array'],
            'image.*.file'        => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
            'image.*.description' => ['nullable'],
            'image.*.name'        => ['nullable'],

            'metas' => ['nullable', 'array'],
            'metas.*.id' => ['sometimes', 'exists:metas,id'],
            'metas.*.name' => ['required'],
        ];
    }
}
