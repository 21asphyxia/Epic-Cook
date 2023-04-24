<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('update own recipes') && $this->recipe->user()->is(auth()->user());    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'string|max:255',
            'description' => 'string|max:255',
            'prep_time' => 'integer',
            'difficulty' => 'integer|min:1|max:5',
            'ingredients' => 'array',
            'ingredients_amounts' => 'array',
            'ingredients_amounts.*' => 'decimal:0,2',
            'ingredients_units' => 'array',
            'ingredients_units.*' => 'string|max:255',
            'instructions' => 'array',
            'instructions.*' => 'string|max:255',
            'images' => 'array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
