<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddMealFormRequest extends FormRequest
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
            'meal_items' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'You must specify a name for the meal',
            'meal_items.required' => 'You must select at least 1 item to make up this meal',
            'description.required' => 'You must provide a description the meal',
        ];
    }
}
