<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DiscorevApiService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Apply the 'auth' middleware to all methods in this controller.
     */
    protected $middleware = ['auth'];

    // ✅ Affiche le profil de l'utilisateur connecté
    public function showProfile()
    {
        $user = User::find(Auth::id());
        return view('profile.show', compact('user'));
    }

    // ✅ Affiche le formulaire d'édition générique
    public function editProfile()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // ✅ Met à jour les informations génériques (nom, email, etc.)
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'phone'      => 'required|string|max:20',
        ]);

        //$user->update($validated);

        return redirect()->back()->with('success', 'Profil mis à jour avec succès.');
    }
}
