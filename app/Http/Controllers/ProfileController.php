<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DiscorevApiService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    public function index()
    {
        return view('account.profile.index');
    }

    public function showCompletionForm()
    {
        return view('account.profile.complete');
    }

    public function update(Request $request)
    {
        $section = $request->input('section');

        switch ($section) {
            case 'general':
                $request->validate([
                    'name' => 'required|string',
                    //'email' => 'required|email|unique:users,email,' . auth()->id(),
                ]);

                //auth()->user()->update($request->only('name', 'email'));
                return back()->with('success_general', 'Informations mises à jour.');

            case 'avatar':
                $request->validate([
                    'profile_picture' => 'required|image|max:2048',
                ]);

                $path = $request->file('profile_picture')->store('avatars', 'public');
                //auth()->user()->update(['profile_picture' => $path]);

                return back()->with('success_avatar', 'Photo mise à jour.');

            case 'location':
                $request->validate([
                    'location' => 'required|string',
                ]);
                //auth()->user()->update(['location' => $request->location]);

                return back()->with('success_location', 'Localisation mise à jour.');

            case 'bio':
                $request->validate([
                    'bio' => 'nullable|string|max:500',
                ]);
                //auth()->user()->update(['bio' => $request->bio]);

                return back()->with('success_bio', 'Biographie mise à jour.');
        }

        return back()->with('error', 'Section inconnue.');
    }
}
