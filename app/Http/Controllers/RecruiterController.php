<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DiscorevApiService;
use App\Models\Api\Recruiter;
use App\Models\Api\JobOffer;
use App\Helpers\NafHelper;
use App\Models\Api\Plan;
use App\Models\Api\RecruiterTeamMember;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RecruiterController extends Controller
{
    private DiscorevApiService $api;

    public function __construct(DiscorevApiService $api)
    {
        $this->api = $api;
    }

    public function index(): View
    {
        // Récupérer les données depuis l'API
        $recruitersData = $this->api->get('recruiters') ?: [];
        $jobsData = $this->api->get('job_offers') ?: [];

        // Convertir les données API en modèles Recruiter
        $recruitersFromApi = collect($recruitersData)
            ->filter(fn($r) => is_array($r))
            ->map(fn($r) => Recruiter::fromApiData($r));

        //        // Créer un recruteur fictif pour tester le front
        //        $dummyRecruiter = new Recruiter();
        //        $dummyRecruiter->id = 999;
        //        $dummyRecruiter->companyName = "Entreprise Test";
        //        $dummyRecruiter->teamSize = "11-50";
        //        $dummyRecruiter->sector = "Aide à la personne";
        //        $dummyRecruiter->location = "Paris";
        //        $dummyRecruiter->website = "https://discorev.fr";
        //        $dummyRecruiter->contactPerson = "contact@exemple.com";
        //        $dummyRecruiter->phone = "0123456789";
        //        $dummyRecruiter->companyDescription = "Description de test pour la mise en page.";
        //        $dummyRecruiter->banner = null;
        //        $dummyRecruiter->logo = null;
        //        $dummyRecruiter->offersCount = 3;
        //        $dummyRecruiter->completionScore = 9;
        //
        //        // Fusionner dummy + API
        //        $recruiters = collect([$dummyRecruiter])->merge($recruitersFromApi);

        $recruiters = $recruitersFromApi;

        // Grouper les offres par recruiter_id
        $jobsByRecruiter = collect($jobsData)
            ->filter(fn($j) => is_array($j))
            ->groupBy('recruiterId');

        // Attacher les offres et médias à chaque recruteur, calculer sectorName
        $recruiters = $recruiters->map(function ($recruiter) use ($jobsByRecruiter) {
            $jobsData = $jobsByRecruiter->get($recruiter->id, collect());
            $jobs = $jobsData->map(fn($jobData) => JobOffer::fromApiData($jobData));

            $medias = collect($recruiter['medias'] ?? []);
            $banner = $medias->firstWhere('type', 'company_banner');
            $logo = $medias->firstWhere('type', 'company_logo');

            $recruiter->setRelation('jobOffers', $jobs);
            $recruiter->offersCount = $jobs->count();
            $recruiter->banner = $banner['filePath'] ?? null;
            $recruiter->logo   = $logo['filePath'] ?? null;

            // Normaliser les contacts
            $recruiter->contactPerson = $recruiter->contactEmail ?? $recruiter->contactPerson ?? null;
            $recruiter->phone = $recruiter->contactPhone ?? $recruiter->phone ?? null;

            // Calculer le score de complétion
            $fields = [
                $recruiter->companyName,
                $recruiter->siret ?? null,
                $recruiter->companyDescription ?? null,
                $recruiter->location ?? null,
                $recruiter->website ?? null,
                $recruiter->sector ?? null,
                $recruiter->teamSize ?? null,
                $recruiter->contactPerson,
                $recruiter->phone,
            ];
            $recruiter->completionScore = collect($fields)->filter(fn($field) => !empty($field))->count();

            $recruiter->sectorName = isset($recruiter->sector)
                ? NafHelper::getLabel($recruiter->sector)
                : null;

            return $recruiter;
        });

        // Récupérer les filtres depuis la requête
        $locationFilter = request('location');
        $sectorFilter = request('sector');
        $teamSizeFilter = request('team_size');

        // Appliquer les filtres
        $recruiters = $recruiters->filter(function ($recruiter) use ($locationFilter, $sectorFilter, $teamSizeFilter) {
            $matches = true;

            if ($locationFilter) {
                $matches = $matches && stripos($recruiter->location, $locationFilter) !== false;
            }
            if ($sectorFilter) {
                $matches = $matches && $recruiter->sectorName === $sectorFilter;
            }
            if ($teamSizeFilter) {
                $matches = $matches && $recruiter->teamSize === $teamSizeFilter;
            }

            return $matches;
        });

        // Trier par score de complétion descendant et éliminer les vides
        $recruiters = $recruiters
            ->filter(fn($r) => $r->completionScore > 0)
            ->sortByDesc('completionScore')
            ->values();

        return view('companies.index', compact('recruiters'));
    }

    /**
     * Met à jour les informations du recruiter via l'API.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'companyName' => 'required|string|max:255',
            'siret' => 'nullable|string|max:20',
            'companyDescription' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'sector' => 'nullable|string|max:100',
            'teamSize' => 'nullable|string|max:50',
            'contactPhone' => ['nullable', 'string', 'min:10', 'max:20', 'regex:/^[0-9+\s\-().]+$/'],
            'contactEmail' => 'nullable|email',
            'delete_logo' => 'nullable|boolean',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'integer',
            'new_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:5120',
            'new_images' => 'nullable|array',
            'new_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        try {
            // 1. Mettre à jour les informations textuelles
            $response = $this->api->put('recruiters/' . $id, [
                'companyName' => $validated['companyName'],
                'siret' => $validated['siret'] ?? null,
                'companyDescription' => $validated['companyDescription'] ?? null,
                'location' => $validated['location'] ?? null,
                'website' => $validated['website'] ?? null,
                'sector' => $validated['sector'] ?? null,
                'teamSize' => $validated['teamSize'] ?? null,
                'contactPhone' => $validated['contactPhone'] ?? null,
                'contactEmail' => $validated['contactEmail'] ?? null,
            ]);

            if (!$response->successful()) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Erreur lors de la mise à jour de l'entreprise.");
            }

            // 2. Gérer la suppression du logo
            if ($request->filled('delete_logo')) {
                $deleteResponse = $this->api->delete("media/recruiter/$id/company_logo");
            }

            // 3. Gérer l'ajout d'un nouveau logo
            if ($request->hasFile('new_logo')) {
                $logoFile = $request->file('new_logo');

                // Créer un formulaire multipart
                $response = Http::attach(
                    'file',
                    file_get_contents($logoFile->getRealPath()),
                    $logoFile->getClientOriginalName()
                )->post(config('app.api') . '/media/upload', [
                    'type' => 'company_logo',
                    'context' => 'company_page',
                    'targetType' => 'recruiter',
                    'targetId' => $id,
                    'title' => 'Logo ' . $validated['companyName'],
                ]);
            }

            // 4. Gérer la suppression des images
            if ($request->filled('delete_images')) {
                foreach ($request->delete_images as $imageId) {
                    $this->api->delete("media/$imageId");
                }
            }

            // 5. Gérer l'ajout de nouvelles images
            if ($request->hasFile('new_images')) {
                foreach ($request->file('new_images') as $imageFile) {
                    Http::attach(
                        'file',
                        file_get_contents($imageFile->getRealPath()),
                        $imageFile->getClientOriginalName()
                    )->post(config('app.api') . '/media/upload', [
                        'type' => 'company_image',
                        'context' => 'company_page',
                        'targetType' => 'recruiter',
                        'targetId' => $id,
                        'title' => 'Galerie ' . $validated['companyName'],
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Profil mis à jour avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur mise à jour recruteur: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la mise à jour.');
        }
    }

    public function show($identifier)
    {
        // Récupère les données du recruiter depuis l'API
        $recruiterData = is_numeric($identifier)
            ? $this->api->get("recruiters/$identifier")
            : $this->api->get("recruiters/company/$identifier");

        if (!$recruiterData) {
            $fallbackView = 'companies.' . strtolower($identifier);
            if (view()->exists($fallbackView)) return view($fallbackView);
            return redirect()->back()->with('error', "Entreprise introuvable.");
        }

        $recruiter = Recruiter::fromApiData($recruiterData);
        $recruiter->sectorName = isset($recruiter->sector)
            ? NafHelper::getLabel($recruiter->sector)
            : null;

        $recruiterId = $recruiter['id'];

        // Job offers
        $jobOffers = $this->api->get("job_offers/recruiter/$recruiterId");

        // Collecte les médias
        $medias = collect($recruiter['medias'] ?? []);

        // Récupère directement les fichiers pour bannière et logo
        $bannerMedia = $medias->firstWhere('type', 'company_banner');
        $logoMedia = $medias->firstWhere('type', 'company_logo');

        $recruiter->banner = $bannerMedia['filePath'] ?? null;
        $recruiter->logo   = $logoMedia['filePath'] ?? null;

        // Configuration des sections pour la vue
        $sectionsConfig = [
            [
                'key' => 'companyDescription',
                'label' => "L'entreprise",
                'anchor' => 'company',
                'type' => 'text',
                'data' => $recruiter['companyDescription'] ?? null
            ],
            [
                'key' => 'teamMembers',
                'label' => "L'équipe",
                'anchor' => 'equipe',
                'type' => 'array',
                'data' => $recruiter['teamMembers'] ?? []
            ],
            [
                'key' => 'video',
                'label' => 'Vidéo',
                'anchor' => 'video',
                'type' => 'video',
                'data' => $medias->where('type', 'company_video')->where('context', 'company_page')
            ],
            [
                'key' => 'medias',
                'label' => 'Médias',
                'anchor' => 'medias',
                'type' => 'media',
                'data' => $medias->where('type', 'company_image')->where('context', 'company_page')
            ]
        ];

        $sections = collect($sectionsConfig)
            ->filter(function ($section) {
                $data = $section['data'];
                if ($data instanceof \Illuminate\Support\Collection) {
                    return $data->isNotEmpty();
                }
                if (is_array($data)) {
                    return !empty($data);
                }
                return !empty($data);
            })
            ->values()
            ->all();

        // Détermination de la vue
        $view = null;
        if (!empty($recruiter['companyName'])) {
            $slugView = 'companies.' . $this->slugify($recruiter['companyName']);
            if (view()->exists($slugView)) {
                $view = $slugView;
            }
        }

        if (!$view) {
            $view = view()->exists('companies.show') ? 'companies.show' : null;
        }

        if ($view) {
            // Passe directement $recruiter avec logo et banner remplis
            return view($view, compact('recruiter', 'sections', 'jobOffers'));
        }

        return redirect()->back()->with('error', "Aucune vue disponible pour afficher cette entreprise.");
    }

    function slugify(string $text): string
    {
        // 1. Convertit en ASCII
        $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);

        // 2. Met en minuscules
        $text = strtolower($text);

        // 3. Remplace tous les caractères non alphanumériques par des tirets
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);

        // 4. Supprime les tirets au début et à la fin
        $text = trim($text, '-');

        return $text;
    }

    public function tarifs()
    {
        $plansApi = $this->api->get('plans');
        $plansElo = Plan::fromApiCollection($plansApi);

        $plans = collect($plansElo)
            ->filter(fn(Plan $plan) => $plan->isActive)
            ->sortBy(
                fn(Plan $plan) => ($plan->isPremium ? 1000 : 0) + ($plan->priceMonth ?? 0)
            )
            ->values();
        return view('account.recruiter.tarifs-recruiters', compact('plans'));
    }
}
