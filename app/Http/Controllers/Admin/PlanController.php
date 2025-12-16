<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DiscorevApiService;
use App\Models\Api\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PlanController extends Controller
{
    private DiscorevApiService $api;

    public function __construct(DiscorevApiService $api)
    {
        $this->api = $api;
    }

    public function index()
    {
        $token = Session::get('accessToken');
        $plansApi = $this->api->get('plans');
        $plans = Plan::fromApiCollection($plansApi);

        //dd($plans);
        return view('admin.plans.index ', compact('token', 'plans'));
    }

    public function create(Request $request)
    {
        $payload = $request->validate([
            'name'            => 'required|string|max:255',
            'priceMonth'      => 'nullable|numeric|min:0',
            'priceYear'       => 'nullable|numeric|min:0',
            'commitment'      => 'nullable|string|max:50',
            'credits'         => 'nullable|string|max:50',
            'adDurationHours' => 'required|integer|min:1',
            'features'        => 'nullable|array',
            'features.*'      => 'string|max:255',
            'isActive'        => 'nullable|boolean',
        ]);

        $payload['isActive'] = $request->has('isActive');
        $payload['features'] = array_values(array_filter($payload['features'] ?? []));

        try {
            $response = $this->api->post('plans', $payload);

            if (!$response->successful()) {
                return back()->withInput()->with('error', 'Erreur lors de la création du plan.');
            }

            return back()->with('success', 'Plan créé ✔️');
        } catch (\Throwable $th) {
            return back()->with('error', 'Une erreur est survenue lors de la création du plan.');
        }
    }


    public function update(Request $request, $id)
    {
        // Récupération du plan via l’API
        $plan = $this->api->get("plans/$id");

        if (!$plan) {
            return back()->with('error', 'Plan introuvable');
        }

        // Validation des données
        $payload = $request->validate([
            'name'             => 'required|string|max:255',
            'priceMonth'       => 'nullable|numeric|min:0',
            'priceYear'        => 'nullable|numeric|min:0',
            'commitment'       => 'nullable|string|max:50',
            'credits'          => 'nullable|string|max:50',
            'adDurationHours'  => 'required|integer|min:1',
            'features'         => 'nullable|array',
            'features.*'       => 'string|max:255',
            'isActive'         => 'nullable|boolean',
        ]);

        // Checkbox OFF → false
        $payload['isActive'] = $request->has('isActive');

        // Sécurité : features vide = tableau vide
        $payload['features'] = array_values(array_filter(
            $payload['features'] ?? []
        ));

        try {
            $response = $this->api->put("plans/$id", $payload);

            if (!$response->successful()) {
                return back()
                    ->withInput()
                    ->with('error', "Erreur lors de la mise à jour du plan.");
            }

            return back()->with('success', 'Plan mis à jour ✔️');
        } catch (\Throwable $th) {
            return back()->with('error', 'Une erreur est survenue lors de la mise à jour.');
        }
    }

    public function delete($id)
    {
        try {
            $this->api->delete("plans/$id");
            return back()->with('success', 'Plan supprimé ✔️');
        } catch (\Throwable $th) {
            return back()->with('error', 'Erreur lors de la suppression du plan.');
        }
    }
}
