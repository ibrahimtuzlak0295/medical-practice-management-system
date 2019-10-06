<?php

namespace App\Http\Requests\Practice;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MinImageDimensions;

class UpdatePracticeRequest extends FormRequest
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
            'name' => 'sometimes|required',
            'email' => 'sometimes|nullable|email',
            'logo' => [
                'sometimes',
                'nullable',
                'image', 
                new MinImageDimensions(100, 100)
            ],
            'website' => 'sometimes|nullable|string',
            'fields_of_practice' => 'sometimes|array|exists:fields_of_practice,id'

        ];
    }
}
