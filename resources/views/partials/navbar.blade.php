<!-- Material Symbols Outlined font for icons -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

<header class="sticky-top">
    <nav class="navbar navbar-expand-lg bg-aquamarine shadow py-2 px-lg-5">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center text-white fw-bold fs-4" href="{{ route('home') }}"
                title="Accueil">
                <img src="{{ asset('img/logo-png.png') }}" alt="logo Discorev" height="40" class="me-2">
                Discorev
            </a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Liens à gauche -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white fw-medium" href="{{ route('home') }}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-medium" href="{{ route('job_offers.index') }}">Offres
                            d'emploi</a>
                    </li>
                </ul>

                <!-- Dropdowns à droite -->
                <ul class="navbar-nav align-items-center gap-lg-3">

                    @if ($isAuthenticated && isset($user))
                        @php
                            $isCandidate = $user['account_type'] === 'candidate';
                            $isRecruiter = $user['account_type'] === 'recruiter';
                        @endphp

                        @if ($isCandidate)
                            <!-- Dropdown Candidat -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white fw-medium" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Candidat
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('applications.index') }}">Mes
                                            candidatures</a></li>
                                </ul>
                            </li>
                        @endif

                        @if ($isRecruiter)
                            <!-- Dropdown Recruteur -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white fw-medium" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Recruteur
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('recruiter.jobs.create') }}">Publier une
                                            offre</a></li>
                                    <li><a class="dropdown-item" href="{{ route('recruiter.jobs.index') }}">Mes
                                            offres</a></li>
                                    <li><a class="dropdown-item" href="{{ route('cvtheque.index') }}">Cvthèque</a></li>
                                </ul>
                            </li>
                        @endif

                        <!-- Icône profil connecté -->
                        <li class="nav-item dropdown">
                            <a href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ $user['profile_picture'] ?? asset('img/default-avatar.png') }}"
                                    alt="Profil" class="rounded-circle me-2 shadow" width="32" height="32">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">
                                        <span class="material-symbols-outlined me-2">person</span> Profil</a></li>
                                <li><a class="dropdown-item" href="{{ route('settings') }}">
                                        <span class="material-symbols-outlined me-2">settings</span> Paramètres</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <span class="material-symbols-outlined me-2">logout</span> Déconnexion
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <!-- Icône profil invité -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="guestDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="material-symbols-outlined fs-4">account_circle</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="guestDropdown">
                                <li><a class="dropdown-item" href="{{ route('auth', ['tab' => 'login']) }}">
                                        <span class="material-symbols-outlined me-2">login</span> Connexion</a></li>
                                <li><a class="dropdown-item" href="{{ route('auth', ['tab' => 'register']) }}">
                                        <span class="material-symbols-outlined me-2">person_add</span> Créer un
                                        compte</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
