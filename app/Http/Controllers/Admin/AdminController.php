<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DiscorevApiService;
use App\Models\Api\JobOffer;
use App\Models\Api\User;
use App\Models\Api\Admin;
use App\Models\Api\History;
use App\Models\Api\Payment;
use App\Models\Api\Subscription;
use App\Models\Api\Tag;
use App\Models\Api\TagCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private DiscorevApiService $api;

    public function __construct(DiscorevApiService $api)
    {
        $this->api = $api;
    }

    public function dashboard()
    {
        $user = Session::get('user');
        $offersApi = $this->api->get('job_offers');
        $users = $this->api->get('users');
        $historyApi = $this->api->get('histories');
        $subscriptionsApi = $this->api->get('subscriptions');
        $paymentsApi = $this->api->get('payments');
        $tagCategoriesApi = $this->api->get('tags/admin');
        $adminsApi = $this->api->get('admins');

        $offers = JobOffer::fromApiCollection($offersApi);
        $users = User::fromApiCollection($users);
        $history = History::fromApiCollection($historyApi);
        $subscriptions = Subscription::fromApiCollection($subscriptionsApi);
        $payments = Payment::fromApiCollection($paymentsApi);
        $tagCategories = TagCategory::fromApiCollection($tagCategoriesApi);
        $admins = Admin::fromApiCollection($adminsApi);
        $paymentsInMonth = $payments->where('paidAt', today())->count();

        $user['permissions'] = []; // toujours défini

        foreach ($admins as $admin) {
            if ($admin->userId === $user['id']) {
                $user['permissions'] = is_string($admin->permissions)
                    ? json_decode($admin->permissions, true)
                    : $admin->permissions;
                break;
            }
        }
        Session::put('user', $user);

        return view('admin.index', compact(
            'user',
            'users',
            'offers',
            'history',
            'payments',
            'subscriptions',
            'tagCategories',
            'admins'
        ));
    }

    public function index()
    {
        $user = Session::get('user');
        $users = $this->api->get('users');
        $adminsApi = $this->api->get('admins');
        $users = User::fromApiCollection($users);

        $admins = Admin::fromApiCollection($adminsApi);
        $admins->transform(function ($admin) use ($users) {
            $admin->user = $users->firstWhere('id', $admin->userId);
            $admin->permissions = json_decode($admin->permissions, true);
            return $admin;
        });
        // dd($admins);
        return view('admin.admins.index ', compact('user', 'users', 'admins'));
    }

    public function update(Request $request, $id)
    {
        // Récupère l'admin via ton API
        $admin = $this->api->get("admins/$id");

        if (!$admin) {
            return back()->with('error', 'Administrateur introuvable');
        }

        // Validation
        $payload = $request->validate([
            'permissions' => 'sometimes|array',
            'role' => 'required|in:super-admin,admin,moderator',
            'status' => 'required|boolean',
        ]);

        // Si super-admin, override tout pour sécurité
        if ($payload['role'] === 'super-admin') {
            $permissions = array_fill_keys(array_keys(\App\Models\Api\Admin::PERMISSIONS_LABELS), true);
        } else {
            // Normalisation des permissions : toutes les clés existantes, false si non cochée
            $permissions = array_merge(
                array_fill_keys(array_keys(\App\Models\Api\Admin::PERMISSIONS_LABELS), false),
                $request->input('permissions', [])
            );

            // Convertir toutes les valeurs en booléens
            $permissions = array_map(fn($v) => (bool)$v, $permissions);
        }

        // Payload à envoyer à l'API
        $payload['permissions'] = $permissions;
        $payload['status'] = (bool)$request->input('status');

        try {
            $response = $this->api->put("admins/{$id}", $payload);

            if (!$response->successful()) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Erreur lors de la mise à jour de l'administrateur.");
            }

            return back()->with('success', 'Administrateur mis à jour ✔️');
        } catch (\Throwable $th) {
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la mise à jour.');
        }
    }
}
