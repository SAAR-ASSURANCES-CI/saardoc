<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('manage', User::class);
        
        $users = User::orderBy('name')->paginate(15);
        
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('manage', User::class);
        
        $roles = ['employe', 'rh', 'admin'];
        
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('manage', User::class);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'matricule' => 'required|string|max:255|unique:users',
            'role' => 'required|in:employe,rh,admin',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'matricule' => $request->matricule,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur créé avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('manage', User::class);
        
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('manage', User::class);
        
        $roles = ['employe', 'rh', 'admin'];
        
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('manage', User::class);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'matricule' => 'required|string|max:255|unique:users,matricule,' . $user->id,
            'role' => 'required|in:employe,rh,admin',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'matricule' => $request->matricule,
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('manage', User::class);
        
        if ($user->id === Auth::id()) {
            return redirect()->route('users.index')
                ->with('error', 'Vous ne pouvez pas supprimer votre propre compte !');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur supprimé avec succès !');
    }

    /**
     * Toggle user block status
     */
    public function toggleBlock(User $user)
    {
        $this->authorize('manage', User::class);
        
        if ($user->id === Auth::id()) {
            return redirect()->route('users.index')
                ->with('error', 'Vous ne pouvez pas bloquer votre propre compte !');
        }

        $user->update(['est_bloque' => !$user->est_bloque]);

        $status = $user->est_bloque ? 'bloqué' : 'débloqué';
        
        return redirect()->route('users.index')
            ->with('success', "Utilisateur {$status} avec succès !");
    }

    /**
     * Change user password
     */
    public function changePassword(Request $request, User $user)
    {
        $this->authorize('manage', User::class);
        
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Mot de passe modifié avec succès !');
    }
}
