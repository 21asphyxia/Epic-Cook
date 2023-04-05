<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IngredientRecipe extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'unit',
    ];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
