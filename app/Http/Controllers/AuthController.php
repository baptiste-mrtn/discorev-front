<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DiscorevApiService;
use Illuminate\Support\Facades\Session;
use App\Services\ApiErrorTranslator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function show($tab = 'login')
    {
        return view('auth.show', ['tab' => $tab]);
    }


    // ✅ Traite le formulaire d'inscription
    public function register(Request $request, DiscorevApiService $api, ApiErrorTranslator $translator)
    {
        $request->merge([
            'newsletter' => $request->has('newsletter'),
        ]);

        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'phoneNumber' => ['required', 'regex:/^[0-9]+$/', 'max:20'],
            'profilePicture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'accountType' => 'required|in:candidate,recruiter',
            'accept-cgu' => 'accepted',
            'accept-confidentiality' => 'accepted',
            'newsletter' => 'nullable|boolean',
        ]);

        $data = [
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => $request->password,
            'phoneNumber' => $request->phoneNumber,
            'accountType' => $request->accountType,
            'newsletter' => $request->newsletter,
        ];

        // Handle profile picture upload if present
        if ($request->hasFile('profilePicture')) {
            $data['profilePicture'] = $request->file('profilePicture');
        }

        // Envoi à l'API
        $response = $api->post('auth/register', $data);

        if (!$response->successful()) {
            $errorMessage = $response->json('message') ?? 'Une erreur est survenue lors de l’inscription.';
            $translated = $translator->translate($errorMessage);
            return back()->withErrors(['auth.register' => $translated])->withInput();
        }

        // Une fois que l'inscription a réussi, on lance la requête login automatique
        $credentials = $request->only('email', 'password');

        $loginResponse = $api->post('auth/login', $credentials);

        $loginData = $loginResponse->json();

        if ($loginResponse->successful() && isset($loginData['token'])) {
            Session::put('access_token', $loginData['token']);
            Session::put('refresh_token', $loginData['refresh_token']);
            Session::put('user', $loginData['data']);

            $user = User::where('email', $loginData['data']['email'])->first();

            if ($user) {
                Auth::login($user);
            }
            return redirect()->route('complete-profile')->with('success', 'Connexion réussie !');
        }

        // Si la connexion automatique échoue, on peut afficher un message d’erreur friendly
        return back()->withErrors(['warning' => 'Inscription réussie, mais la connexion automatique a échoué. Veuillez vous connecter manuellement.']);
    }

    public function login(Request $request, DiscorevApiService $api)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $response = $api->post('auth/login', $request->only('email', 'password'));

        $responseData = $response->json();

        if ($response->successful() && isset($responseData['token'])) {
            // Rechercher l'utilisateur dans la BDD à partir de son email (ou id)
            $user = User::where('email', $responseData['data']['email'])->first();
            // Vérifie qu'on l'a bien trouvé
            if ($user) {
                Auth::login($user);
            }

            Session::put('access_token', $responseData['token']);
            Session::put('refresh_token', $responseData['refresh_token']);
            Session::put('user', $responseData['data']);

            return redirect()->route('home')->with('success', 'Connexion réussie !');
        }

        return back()->withErrors(['email' => 'Identifiants incorrects.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Vous avez été déconnecté avec succès.');
    }
}
