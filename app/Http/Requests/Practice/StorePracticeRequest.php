<?php

namespace App\Http\Requests\Practice;

use App\Rules\MinImageDimensions;
use Illuminate\Foundation\Http\FormRequest;

class StorePracticeRequest extends FormRequest
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
            'email' => 'nullable|email',
            'logo' => [
                'nullable',
                'image', 
                new MinImageDimensions(100, 100)
            ],
            'website' => 'nullable|string',
            'fields_of_practice' => 'array|exists:fields_of_practice,id'
        ];
    }
}
