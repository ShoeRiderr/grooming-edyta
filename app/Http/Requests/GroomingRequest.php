<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroomingRequest extends FormRequest
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

            'metas' => ['nullable', 'array'],
            'metas.*.id' => ['sometimes', 'exists:metas,id'],
            'metas.*.name' => ['required'],
        ];
    }
}
