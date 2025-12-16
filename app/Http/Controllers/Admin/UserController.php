<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DiscorevApiService;
use App\Models\Api\JobOffer;
use App\Models\Api\Recruiter;
use App\Models\Api\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    private DiscorevApiService $api;

    public function __construct(DiscorevApiService $api)
    {
        $this->api = $api;
    }

    public function index()
    {
        $user = Session::get('user');

        // Récupération des recruteurs et indexation par ID
        $usersApi = $this->api->get('users');
        $users = User::fromApiCollection($usersApi);

        return view('admin.users.index', compact('users', 'user'));
    }


    public function update(Request $request, $id)
    {
        // récupère l'offre depuis ton système API
        $user = $this->api->get("users/$id");

        if (!$user) {
            return back()->with('error', 'Utilisateur introuvable');
        }

        // données mises à jour
        $payload = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'phone'      => 'required|string|max:20',
            'isActive' => 'required|boolean'
        ]);

        try {
            $response = $this->api->put(
                'users/' . $id,
                $payload
            );
            if (!$response->successful()) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Erreur lors de la mise à jour de l'utilisateur.");
            }

            return back()->with('success', 'Utilisateur mis à jour ✔️');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la mise à jour.');
        }
    }

    public function delete($id)
    {
        $this->api->delete("users/$id");

        return redirect()->back()->with('success', 'Utilisateur supprimé');
    }
}
