<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $users = User::orderBy('name')->paginate(15);
        
        return view('livewire.users.index', [
            'users' => $users,
        ]);
    }
}
