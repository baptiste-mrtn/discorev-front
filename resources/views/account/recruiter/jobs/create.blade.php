@extends('layouts.app')
@section('title', 'Créer une offre | Discorev')

@section('content')
    <div class="container">
        <h2>Créer une offre d'emploi</h2>
        <form action="{{ route('recruiter.jobs.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Titre du poste</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label for="requirements" class="form-label">Exigences</label>
                <textarea class="form-control" id="requirements" name="requirements" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="salary_range" class="form-label">Fourchette salariale</label>
                <input type="text" class="form-control" id="salary_range" name="salary_range">
            </div>

            <div class="mb-3">
                <label for="employment_type" class="form-label">Type de contrat</label>
                <select class="form-select" id="employment_type" name="employment_type" required>
                    <option value="">Sélectionner</option>
                    <option value="cdi">CDI</option>
                    <option value="cdd">CDD</option>
                    <option value="freelance">Freelance</option>
                    <option value="alternance">Alternance</option>
                    <option value="stage">Stage</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Lieu</label>
                <input type="text" class="form-control" id="location" name="location">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remote" name="remote" value="1">
                <label class="form-check-label" for="remote">Télétravail possible</label>
            </div>

            <div class="mb-3">
                <label for="expiration_date" class="form-label">Date d'expiration</label>
                <input type="date" class="form-control" id="expiration_date" name="expiration_date">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Statut</label>
                <select class="form-select" id="status" name="status">
                    <option value="active" selected>Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="draft">Brouillon</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Créer l'offre</button>
        </form>
    </div>
@endsection
