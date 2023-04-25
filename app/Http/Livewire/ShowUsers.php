<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUsers extends Component
{
    use WithPagination;
    public $search = '';

    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        $users = User::with('recipes','ratings', 'comments')->where('name', 'like', '%' . $this->search . '%');
        return view('livewire.show-users', ['users' => $users->paginate(8)]);
    }
}
