<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\DiscorevApiService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class JobOfferController extends Controller
{

    public function index(DiscorevApiService $api)
    {
        $response = $api->get('job_offers');

        if ($response->successful()) {
            $offers = $response->json()['data'];
            return view('job_offers.index', compact('offers'));
        }

        abort(500, 'Erreur lors de la récupération des offres.');
    }

    public function show(DiscorevApiService $api)
    {
        $response = $api->get('job_offers');

        if ($response->successful()) {
            $offers = $response->json()['data'];
            return view('job_offers.index', compact('offers'));
        }

        abort(500, 'Erreur lors de la récupération des offres.');
    }

    public function myOffers(DiscorevApiService $api)
    {
        $recruiter = auth()->user()->recruiter;

        if ($recruiter) {
            $recruiterId = $recruiter->id;
        } else {
            Redirect::back()->withErrors(['error' => 'L\'utilisateur n\'est pas un recruteur']);
        }

        $response = $api->get('job_offers/filters', [
            'recruiterId' => $recruiterId
        ]);

        if ($response->successful()) {
            $offers = $response->json()['data'];
            return view('job_offers.index', compact('offers'));
        }

        abort(500, 'Erreur lors de la récupération des offres.');
    }

    public function create()
    {
        return view('account.recruiter.jobs.create');
    }

    public function store(Request $request, DiscorevApiService $api)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
            'requirements' => 'nullable|string',
            'salary_range' => 'nullable|string|max:255',
            'employment_type' => 'required|string|in:cdi,cdd,freelance,alternance,stage',
            'remote' => 'nullable|boolean',
            'expiration_date' => 'nullable|date',
            'status' => 'required|string|in:active,inactive,draft',
        ]);

        $recruiter = auth()->user()->recruiter;
        if (!$recruiter) {
            return Redirect::back()->withErrors(['error' => 'L\'utilisateur n\'est pas un recruteur']);
        }

        $data = array_merge($validated, [
            'recruiter_id' => $recruiter->id,
        ]);

        $response = $api->post('job_offers', $data);

        if ($response->successful()) {
            return redirect()->route('recruiter.job_offers.index')->with('success', 'Offre créée avec succès.');
        }

        return Redirect::back()->withErrors(['error' => 'Erreur lors de la création de l\'offre.']);
    }

    public function edit(DiscorevApiService $api)
    {
        $response = $api->get('job_offers');

        if ($response->successful()) {
            $offers = $response->json()['data'];
            return view('job_offers.index', compact('offers'));
        }

        abort(500, 'Erreur lors de la récupération des offres.');
    }

    public function update(DiscorevApiService $api)
    {
        $response = $api->get('job_offers');

        if ($response->successful()) {
            $offers = $response->json()['data'];
            return view('job_offers.index', compact('offers'));
        }

        abort(500, 'Erreur lors de la récupération des offres.');
    }

    public function destroy(DiscorevApiService $api)
    {
        $response = $api->get('job_offers');

        if ($response->successful()) {
            $offers = $response->json()['data'];
            return view('job_offers.index', compact('offers'));
        }

        abort(500, 'Erreur lors de la récupération des offres.');
    }
}
