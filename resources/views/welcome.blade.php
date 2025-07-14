@extends('layouts.app')

@section('title', 'Liste des offres')

@section('content')

    <section class="hero container py-5">
        <div class="container row align-items-center">
            <div class="col-lg-6 hero-left">
                <h1 class="mb-4">L'emploi social, <br>à portée de main.</h1>
                <h2 class="mb-4">
                    Construisez votre carrière dans le
                    <span class="highlight-blue">social</span> et accédez à des offres d’emploi
                    <span class="highlight-orange">proche</span> de chez vous avec ou sans expérience.
                </h2>

                <form class="search-bar-welcome d-flex align-items-center mb-4" role="search">
                    <div class="search-input-container d-flex align-items-center flex-grow-1 me-3">
                        <span class="material-symbols-outlined me-2 text-secondary">search</span>
                        <input type="text" class="form-control me-3" placeholder="Job, secteur, mots-clés ..."
                               aria-label="Job, secteur, mots-clés">
                        <span class="separator mx-2 d-none d-md-block"></span>
                        <span class="material-symbols-outlined me-2 text-secondary">location_on</span>
                        <input type="text" class="form-control location" placeholder="Lieu" aria-label="Lieu"
                               style="max-width: 150px;">
                    </div>
                    <button type="submit" class="cta-button-transparent btn-primary px-4">Rechercher</button>
                </form>

                <div class="btn-container d-flex gap-3 flex-wrap">
                    <a href="{{ route('login') }}" style="text-decoration:none;">
                        <button class="cta-button-transparent d-flex align-items-center gap-2">
                            <span class="material-symbols-outlined">work</span> Je recrute
                        </button>
                    </a>

                    <a href="{{ route('login') }}" style="text-decoration:none;">
                        <button class="cta-button-transparent d-flex align-items-center gap-2">
                            <span class="material-symbols-outlined">search</span> Je cherche un emploi
                        </button>
                    </a>

                </div>
            </div>

            <div class="welcome-img col-lg-6 hero-right text-center mt-4 mt-lg-0">
                <img src="{{ asset('img/accueil.png') }}" alt="Illustration" class="img-fluid">
            </div>
        </div>
    </section>


    <section class="explore-companies">
        <div class="container">
            <h2>Explorer les entreprises</h2>
            <h4>Découvrez des entreprises qui recrutent activement dans le secteur social.</h4>

            <div class="row gy-4 mt-4 mb-5">
                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('companies.le-petit-jean') }}" class="company-card">
                        <img src="{{ asset('img/petit-jean.jpg') }}" alt="Entreprise 1">
                        <h3>Le Petit Jean</h3>
                        <p>Une équipe engagée pour un impact social fort.</p>
                        <div class="offers-text">+54 offres</div>
                        <div class="card-icon">
                            <span class="material-symbols-outlined text-white">arrow_forward</span>
                        </div>
                    </a>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('companies.altidom') }}" class="company-card">
                        <img src="{{ asset('img/altidom/altidom.webp') }}" alt="Entreprise 2">
                        <h3>Altidom</h3>
                        <p>Des services à domicile avec l’exigence du monde professionnel.</p>
                        <div class="offers-text">+10 offres</div>
                        <div class="card-icon">
                            <span class="material-symbols-outlined text-white">arrow_forward</span>
                        </div>
                    </a>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('companies.azae') }}" class="company-card">
                        <img src="{{ asset('img/azae.jpg') }}" alt="Entreprise 3">
                        <h3>Azaé</h3>
                        <p>Découvrez leurs opportunités et valeurs.</p>
                        <div class="offers-text">+54 offres</div>
                        <div class="card-icon">
                            <span class="material-symbols-outlined text-white">arrow_forward</span>
                        </div>
                    </a>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                    <a href="{{ route('companies.azae') }}" class="company-card">
                        <img src="{{ asset('img/peit-fils.jpg') }}" alt="Entreprise 4">
                        <h3>Petit Fils</h3>
                        <p>Rejoignez une entreprise qui partage vos valeurs.</p>
                        <div class="offers-text">+54 offres</div>
                        <div class="card-icon">
                            <span class="material-symbols-outlined text-white">arrow_forward</span>
                        </div>
                    </a>
                </div>

                <!-- Répétition des entreprises -->
                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                    <div class="company-card">
                        <img src="{{ asset('img/azae.jpg') }}" alt="Entreprise 5">
                        <h3>Azaé</h3>
                        <p>Découvrez leurs opportunités et valeurs.</p>
                        <a class="cta-link" href="#">+54 offres</a>
                        <div class="card-icon"><span class="material-symbols-outlined text-white">arrow_forward</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                    <div class="company-card">
                        <img src="{{ asset('img/petit-jean.jpg') }}" alt="Entreprise 6">
                        <h3>Le Petit Jean</h3>
                        <p>Une équipe engagée pour un impact social fort.</p>
                        <a class="cta-link" href="#">+18 offres</a>
                        <div class="card-icon"><span class="material-symbols-outlined text-white">arrow_forward</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                    <div class="company-card">
                        <img src="{{ asset('img/peit-fils.jpg') }}" alt="Entreprise 7">
                        <h3>Petit Fils</h3>
                        <p>Rejoignez une entreprise qui partage vos valeurs.</p>
                        <a class="cta-link" href="#">+32 offres</a>
                        <div class="card-icon"><span class="material-symbols-outlined text-white">arrow_forward</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                    <div class="company-card">
                        <img src="{{ asset('img/senior-compagnie.png') }}" alt="Entreprise 8">
                        <h3>Senior Compagnie</h3>
                        <p>Rejoignez une entreprise qui partage vos valeurs.</p>
                        <a class="cta-link" href="#">+142 offres</a>
                        <div class="card-icon"><span class="material-symbols-outlined text-white">arrow_forward</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="#" class="cta-button-transparent">Voir plus d'entreprises</a>
            </div>
        </div>
    </section>


    <section class="find-job py-5">
        <div class="container container-fluid">
            <div class="mb-5">
                <h2>Trouvez votre job en toute simplicité</h2>
                <h4>Avec Discorev, tout devient plus clair.</h4>
            </div>

            <!-- Bloc 1 -->
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ asset('img/following.jpg') }}" alt="Suivi des candidatures" class="img-fluid rounded">
                </div>
                <div class="col-lg-6">
                    <h2>Suivez votre candidature en temps réel</h2>
                    <p>Ne restez plus dans le flou ! Postulez et suivez l’avancée de vos candidatures à chaque étape.
                        Vous
                        êtes informé dès qu’il y a du nouveau.</p>
                    <a href="#" class="cta-button-transparent">Explorer les offres</a>
                </div>
            </div>

            <!-- Bloc 2 -->
            <div class="row align-items-center flex-lg-row-reverse mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ asset('img/paperwork.jpg') }}" alt="Offres transparentes" class="img-fluid rounded">
                </div>
                <div class="col-lg-6">
                    <h2>Des offres d’emploi sans surprise</h2>
                    <p>Fini les annonces vagues ! Salaire, conditions de travail, avantages… Vous avez toutes les infos
                        pour
                        choisir en toute confiance.</p>
                    <a href="#" class="cta-button-transparent">Chercher un job</a>
                </div>
            </div>

            <!-- Bloc 3 -->
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ asset('img/team.jpg') }}" alt="Recruteurs transparents" class="img-fluid rounded">
                </div>
                <div class="col-lg-6">
                    <h2>Des recruteurs à votre écoute</h2>
                    <p>Découvrez des entreprises qui recrutent activement et qui partagent leurs valeurs, leurs
                        processus et
                        leurs opportunités en toute transparence.</p>
                    <a href="#" class="cta-button-transparent">Découvrir les entreprises</a>
                </div>
            </div>
        </div>
    </section>


    <section class="user-choice">
        <h2 style="margin-bottom: 3rem">Que vous soyez recruteur ou candidat, <br> notre plateforme vous accompagne.</h2>

        <div class="choice-container">
            <!-- Carte Employeur -->
            <a href="pages/employeurs.php" class="choice-card employer">
                <h3>Je suis employeur</h3>
                <p>Publiez des offres et recrutez les meilleurs talents facilement.</p>
                <span class="cta-button">Accéder au service</span>
            </a>

            <!-- Carte Candidat -->
            <a href="pages/candidats.php" class="choice-card candidate">
                <h3>Je suis candidat</h3>
                <p>Recherchez un emploi et déposez votre CV en quelques clics.</p>
                <span class="cta-button">Trouver un job</span>
            </a>
        </div>
    </section>

    <section class="competences">
        <div class="container">
            <h2 class="mb-4">Trouver un job facilement avec Discorev</h2>
            <p class="mb-5">Notre plateforme vous aide à décrocher l'emploi qui correspond à votre profil, avec des
                outils et un accompagnement dédié.</p>

            <div class="row g-4">
                <div class="col-md-3">
                    <div class="feature text-start h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle d-flex justify-content-center align-items-center me-3"
                                 style="background-color: var(--orangish); color: white;">
                                <span class="material-symbols-outlined text-white">search</span>
                            </div>
                            <h3 class="mb-0">Offres ciblées</h3>
                        </div>
                        <p>Des opportunités adaptées à votre expérience et votre localisation.</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="feature text-start h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle d-flex justify-content-center align-items-center me-3"
                                 style="background-color: var(--aquamarine); color: white;">
                                <span class="material-symbols-outlined text-white">bolt</span>
                            </div>
                            <h3 class="mb-0">Candidature rapide</h3>
                        </div>
                        <p>Postulez en un clic, avec ou sans CV.</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="feature text-start h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle d-flex justify-content-center align-items-center me-3"
                                 style="background-color: var(--indigo); color: white;">
                                <span class="material-symbols-outlined text-white">verified</span>
                            </div>
                            <h3 class="mb-0">Employeurs fiables</h3>
                        </div>
                        <p>Des entreprises engagées et vérifiées dans le secteur social.</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="feature text-start h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle d-flex justify-content-center align-items-center me-3"
                                 style="background-color: var(--larch-bolete); color: white;">
                                <span class="material-symbols-outlined text-white">groups</span>
                            </div>
                            <h3 class="mb-0">Communauté active</h3>
                        </div>
                        <p>Échangez avec des professionnels du secteur et partagez votre expérience.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="download-app py-5">
        <div class="container">
            <div class="row align-items-center">
                <!-- Image mockup -->
                <div class="col-12 col-lg-6 text-center mb-4 mb-lg-0">
                    <img class="img-fluid app-mockup" src="{{ asset('img/mockup-app.png') }}"
                         alt="Apercu de l'app Discorev">
                </div>

                <!-- Text and buttons -->
                <div class="col-12 col-lg-6 app-infos text-center text-lg-start">
                    <h1 class="mb-3">Votre carrière, toujours à portée de main</h1>
                    <p class="mb-4">Accédez aux meilleures offres d'emploi où que vous soyez et postulez en un clic.</p>
                    <div class="app-buttons d-flex justify-content-center justify-content-lg-start gap-3 flex-wrap">
                        <a href="#" class="cta-button-transparent d-flex align-items-center gap-2">
                            <span class="material-symbols-outlined text-white">android</span> Google Play
                        </a>
                        <a href="#" class="cta-button-transparent d-flex align-items-center gap-2">
                            <i class="fa-brands fa-app-store-ios"></i> App Store
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
