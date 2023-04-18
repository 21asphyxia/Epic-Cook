<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRecipeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'prep_time' => 'required|integer',
            'difficulty' => 'required|integer|min:1|max:5',
            'ingredients' => 'required|array',
            'ingredients.*' => [
                'required',
                function ($value, $key) use (&$ingredientName) {
                    if (!is_numeric($value)) {
                        $ingredientName[$key] = $value;
                    }
                },
                'sometimes',
                Rule::exists('ingredients', 'id')->when(function ($value, $key) use ($ingredientName) {
                    return !is_string($value) && isset($ingredientName[$key]);
                }),
                'string|max:255|required_if:ingredient_name_*'
            ],
            'ingredients_amounts' => 'required|array',
            'ingredients_amounts.*' => 'required|float',
            'ingredients_units' => 'required|array',
            'ingredients_units.*' => 'required|string|max:255',
            'instructions' => 'required|array',
            'instructions.*' => 'required|string|max:255',
            'image' => 'required|array',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
