@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2>Mon profil</h2>

        {{-- Section Infos générales --}}
        <form method="POST" action="{{ route('profile.update') }}" class="mb-4">
            @csrf
            <input type="hidden" name="section" value="general">
            <h5>Informations générales</h5>

            @if (session('success_general'))
                <div class="alert alert-success">{{ session('success_general') }}</div>
            @endif

            <div class="mb-2">
                <label>Nom</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}">
            </div>
            <div class="mb-2">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}">
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>

        {{-- Section Avatar --}}
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mb-4">
            @csrf
            <input type="hidden" name="section" value="avatar">
            <h5>Photo de profil</h5>

            @if (session('success_avatar'))
                <div class="alert alert-success">{{ session('success_avatar') }}</div>
            @endif

            <div class="mb-2">
                <input type="file" name="profile_picture" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Changer la photo</button>
        </form>

        {{-- Section Localisation --}}
        <form method="POST" action="{{ route('profile.update') }}" class="mb-4">
            @csrf
            <input type="hidden" name="section" value="location">
            <h5>Localisation</h5>

            @if (session('success_location'))
                <div class="alert alert-success">{{ session('success_location') }}</div>
            @endif

            <input type="text" name="location" class="form-control"
                value="{{ old('location', auth()->user()->location) }}">
            <button type="submit" class="btn btn-primary mt-2">Mettre à jour</button>
        </form>

        {{-- Section Biographie --}}
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            <input type="hidden" name="section" value="bio">
            <h5>Biographie</h5>

            @if (session('success_bio'))
                <div class="alert alert-success">{{ session('success_bio') }}</div>
            @endif

            <textarea name="bio" rows="4" class="form-control">{{ old('bio', auth()->user()->bio) }}</textarea>
            <button type="submit" class="btn btn-primary mt-2">Mettre à jour</button>
        </form>
    </div>
@endsection
