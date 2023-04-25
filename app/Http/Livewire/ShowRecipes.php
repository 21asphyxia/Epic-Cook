<?php

namespace App\Http\Livewire;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\WithPagination;

class ShowRecipes extends Component
{
    use WithPagination;
    public $search = '';
    public $difficulty = null;
    public $minRating = null;
    public $maxRating = null;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $recipes = Recipe::with('ratings', 'comments', 'images', 'user')->orderBy('created_at', 'desc')->where('name', 'like', '%' . $this->search . '%');

        if ($this->difficulty) {
            $recipes = $recipes->where('difficulty', '<=', $this->difficulty);
        }

        if ($this->minRating) {
            $recipes = $recipes->withAvg('ratings', 'rating_number')
                ->having('ratings_avg_rating_number', '>=', $this->minRating);

            if ($this->maxRating) {
                $recipes = $recipes->having('ratings_avg_rating_number', '<=', $this->maxRating);
            }
        } elseif ($this->maxRating) {
            $recipes = $recipes->withAvg('ratings', 'rating_number')
                ->having('ratings_avg_rating_number', '<=', $this->maxRating);
        }

        $recipes = $recipes->paginate(8);

        return view('livewire.show-recipes', ['recipes' => $recipes]);
    }
}
