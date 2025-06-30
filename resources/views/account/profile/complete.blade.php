@extends('layouts.app')
@section('title', 'Compléter mon profil | Discorev')

@section('content')
    @php
        $type = auth()->user()->account_type;
    @endphp
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h2>Compléter votre profil de {{ $type === 'candidate' ? 'Candidat' : 'Recruteur' }}</h2>
            <a class="text-muted text-decoration-none" href="{{ route('home') }}">Passer</a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf

                @if ($type === 'recruiter')
                    @include('partials.recruiter-fields')
                @elseif ($type === 'candidate')
                    @include('partials.candidate-fields')
                @endif

                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
    </div>
@endsection
