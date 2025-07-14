@extends('layouts.app')

@section('title', 'Azaé - Fiche entreprise')

@section('content')
    <section class="company-header py-5 bg-light text-center">
        <div class="container">
            <img src="{{ asset('img/azae.jpg') }}" alt="Logo Azaé" class="mb-3" style="max-height: 120px;">
            <h1 class="mb-2">Azaé</h1>
            <p class="lead">Découvrez leurs opportunités et valeurs.</p>
            <span class="badge bg-primary mt-2">+54 offres disponibles</span>
        </div>
    </section>

    <section class="company-details py-5">
        <div class="container">
            <h2>À propos de l'entreprise</h2>
            <p>Azaé est une entreprise engagée dans le secteur de l’aide à domicile. Sa mission est de proposer un accompagnement humain et de qualité, respectueux des bénéficiaires et de leurs proches.</p>

            <h3 class="mt-4">Nos valeurs</h3>
            <ul>
                <li>Respect & bienveillance</li>
                <li>Engagement social</li>
                <li>Professionnalisme et écoute</li>
            </ul>

            <h3 class="mt-4">Pourquoi nous rejoindre ?</h3>
            <p>Nous valorisons les parcours, les vocations et les initiatives. Intégrer Azaé, c’est rejoindre un collectif solidaire, qui a du sens et qui recrute partout en France.</p>

            <a href="#" class="btn btn-primary mt-4">Voir les offres chez Azaé</a>
        </div>
    </section>
@endsection
