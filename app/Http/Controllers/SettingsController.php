<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DiscorevApiService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function update(Request $request)
    {
        $section = $request->input('section');

        switch ($section) {
            case 'password':
                $request->validate([
                    'current_password' => 'required',
                    'new_password' => 'required|min:8|confirmed',
                ]);

                // if (!Hash::check($request->current_password, auth()->user()->password)) {
                //     return back()->withErrors(['current_password' => 'Mot de passe actuel incorrect.']);
                // }

                //auth()->user()->update(['password' => bcrypt($request->new_password)]);
                return back()->with('success_password', 'Mot de passe mis à jour.');

            case 'notifications':
                // Exemple fictif
                // auth()->user()->update([
                //     'email_notifications' => $request->has('email_notifications'),
                // ]);
                return back()->with('success_notifications', 'Préférences de notification mises à jour.');

            case 'delete':
                $request->validate([
                    'confirm_delete' => 'accepted',
                ]);
                //auth()->user()->delete();
                return redirect('/')->with('success', 'Compte supprimé.');
        }

        return back()->with('error', 'Section inconnue.');
    }
}
