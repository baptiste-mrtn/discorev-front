@extends('layouts.app')

@section('title', 'Liste des offres')

@section('content')
    <h1>Offres d'emploi</h1>
    <ul>
        @foreach ($offers as $offer)
            <li>{{ $offer['title'] }} - {{ $offer['location'] }}</li>
        @endforeach
    </ul>
@endsection
