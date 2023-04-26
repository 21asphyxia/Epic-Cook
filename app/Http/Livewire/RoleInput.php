<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

use function Psy\debug;

class RoleInput extends Component
{
    public $user;

    public $selectedRole;
    
    public function updatedSelectedRole()
    {
        $this->user->syncRoles($this->selectedRole);
        $this->user->save();
    }

    public function render()
    {
        $this->selectedRole = $this->user->roles->first()->name;
        return view('livewire.role-input', [
            'roles' => Role::all(),
        ]);
    }
}
