@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2>Paramètres du compte</h2>

        {{-- Section Mot de passe --}}
        <form method="POST" action="{{ route('settings.update') }}" class="mb-4">
            @csrf
            <input type="hidden" name="section" value="password">
            <h5>Modifier le mot de passe</h5>

            @if (session('success_password'))
                <div class="alert alert-success">{{ session('success_password') }}</div>
            @endif

            <div class="mb-2">
                <label>Mot de passe actuel</label>
                <input type="password" name="current_password" class="form-control">
                @error('current_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-2">
                <label>Nouveau mot de passe</label>
                <input type="password" name="new_password" class="form-control">
            </div>

            <div class="mb-2">
                <label>Confirmer le nouveau mot de passe</label>
                <input type="password" name="new_password_confirmation" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>

        {{-- Section Notifications --}}
        <form method="POST" action="{{ route('settings.update') }}" class="mb-4">
            @csrf
            <input type="hidden" name="section" value="notifications">
            <h5>Notifications</h5>

            @if (session('success_notifications'))
                <div class="alert alert-success">{{ session('success_notifications') }}</div>
            @endif

            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="email_notifications"
                    {{ auth()->user()->email_notifications ? 'checked' : '' }}>
                <label class="form-check-label">Recevoir des notifications par e-mail</label>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Sauvegarder</button>
        </form>

        {{-- Section Suppression --}}
        <form method="POST" action="{{ route('settings.update') }}">
            @csrf
            <input type="hidden" name="section" value="delete">
            <h5 class="text-danger">Supprimer mon compte</h5>
            <div class="form-check">
                <input type="checkbox" name="confirm_delete" value="1" class="form-check-input" id="confirmDelete">
                <label class="form-check-label" for="confirmDelete">Je confirme la suppression de mon compte</label>
                @error('confirm_delete')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-danger mt-2">Supprimer définitivement</button>
        </form>
    </div>
@endsection
