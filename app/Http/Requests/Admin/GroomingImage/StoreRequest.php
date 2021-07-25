<?php

namespace App\Http\Requests\Admin\GroomingImage;

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
            'document.image'    => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
            'document.dog_race' => ['required'],
            'document.dog_name' => ['required'],
        ];
    }
}
