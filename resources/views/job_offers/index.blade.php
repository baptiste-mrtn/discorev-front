@extends('layouts.app')

@section('title', 'Liste des offres')

@section('content')
    <section class="container search-section">
        <h1>Vous aussi, trouvez le <span class="highlight">job idéal</span></h1>

        <div class="container-fluid">
            <div class="search-bar">
                <div class="input-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" name="query" placeholder="Recherchez par job, mot-clé ou entreprise"
                           value="{{ request('query') }}">
                </div>

                <div class="input-wrapper">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="text" name="location" placeholder="France" value="{{ request('location') }}">
                </div>

                <select name="job_type">
                    <option value="" selected disabled>Type de job</option>
                    <option value="CDI" {{ request('job_type') == 'CDI' ? 'selected' : '' }}>CDI</option>
                    <option value="CDD" {{ request('job_type') == 'CDD' ? 'selected' : '' }}>CDD</option>
                    <option value="Stage" {{ request('job_type') == 'Stage' ? 'selected' : '' }}>Stage</option>
                </select>

                <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
            {{--        <form action="{{ route('offers.search') }}" method="GET" class="search-bar"> </form>--}}
        </div>


        <div class="filters">
            <button type="button" data-filter="remote"><i class="fa-solid fa-house-laptop"></i> Télétravail</button>
            <button type="button" data-filter="profession"><i class="fa-solid fa-users"></i> Professions</button>
            <button type="button" data-filter="sector"><i class="fa-solid fa-building"></i> Secteur</button>
            <button type="button" class="black" data-filter="all"><i class="fa-solid fa-sliders"></i> Tous les filtres
            </button>
        </div>
    </section>

    <section class="cta-banner">
        <img src="https://img.icons8.com/ios/100/calendar--v1.png" alt="Illustration">
        <div class="cta-content">
            <h2>Ne cherchez plus. Créez votre profil et recevez chaque jour notre sélection de jobs faits pour
                vous.</h2>
            <a href="{{ route('register') }}" class="cta-button">Créer mon profil</a>
        </div>
    </section>

    <section id="offers-list-container" class="offers-list-container">
        <div class="container">
            <div id="offers-list" class="offers-list">
                @if(!empty($offers) && $offers->count())
                    @foreach($offers as $offer)
                        <div class="offer-card">
                            <h3>{{ $offer->title }}</h3>
                            <p>{{ $offer->location }}</p>
                            <a href="{{ route('offers.show', $offer->id) }}" class="btn btn-link">Voir l'offre</a>
                        </div>
                    @endforeach
                @else
                    <p>Aucune offre trouvée.</p>
                @endif
            </div>
        </div>
    </section>

    <ul>
        @foreach ($offers as $offer)
            <li>{{ $offer['title'] }} - {{ $offer['location'] }}</li>
        @endforeach
    </ul>
@endsection
