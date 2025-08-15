<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

#[Layout('components.layouts.app')]
class Create extends Component
{
    public string $name = '';
    public string $email = '';
    public string $matricule = '';
    public string $role = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'matricule' => 'required|string|max:255|unique:users',
            'role' => 'required|in:employe,rh,admin',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function store()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'matricule' => $this->matricule,
            'role' => $this->role,
            'password' => Hash::make($this->password),
        ]);

        session()->flash('success', 'Utilisateur créé avec succès !');
        return redirect()->route('users.index');
    }

    public function render()
    {
        $roles = ['employe', 'rh', 'admin'];
        
        return view('livewire.users.create', [
            'roles' => $roles,
        ]);
    }
}
