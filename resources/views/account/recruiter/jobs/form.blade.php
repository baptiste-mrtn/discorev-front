@extends('layouts.app')
@section('title', isset($jobOffer) ? 'Modifier une offre | Discorev' : 'Créer une offre | Discorev')

@section('content')
    <div class="container">
        <h2>{{ isset($jobOffer) ? 'Modifier' : 'Créer' }} une offre d'emploi</h2>

        <form
            action="{{ isset($jobOffer) ? route('recruiter.jobs.update', $jobOffer['id']) : route('recruiter.jobs.store') }}"
            method="POST">
            @csrf
            @if (isset($jobOffer))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="title" class="form-label">Titre du poste</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $jobOffer['title'] ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $jobOffer['description'] ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="requirements" class="form-label">Exigences</label>
                <textarea class="form-control" id="requirements" name="requirements" rows="3">{{ old('requirements', $jobOffer['requirements'] ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="salary_range" class="form-label">Fourchette salariale</label>
                <input type="text" class="form-control" id="salary_range" name="salary_range"
                    value="{{ old('salary_range', $jobOffer['salary_range'] ?? '') }}">
            </div>

            <div class="mb-3">
                <label for="employment_type" class="form-label">Type de contrat</label>
                <select class="form-select" id="employment_type" name="employment_type" required>
                    @php $types = ['cdi' => 'CDI', 'cdd' => 'CDD', 'freelance' => 'Freelance', 'alternance' => 'Alternance', 'stage' => 'Stage']; @endphp
                    <option value="">Sélectionner</option>
                    @foreach ($types as $value => $label)
                        <option value="{{ $value }}"
                            {{ old('employment_type', $jobOffer['employment_type'] ?? '') === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Lieu</label>
                <input type="text" class="form-control" id="location" name="location"
                    value="{{ old('location', $jobOffer['location'] ?? '') }}">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remote" name="remote" value="1"
                    {{ old('remote', $jobOffer['remote'] ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="remote">Télétravail possible</label>
            </div>

            <div class="mb-3">
                <label for="expiration_date" class="form-label">Date d'expiration</label>
                <input type="date" class="form-control" id="expiration_date" name="expiration_date"
                    value="{{ old('expiration_date', isset($jobOffer['expiration_date']) ? \Carbon\Carbon::parse($jobOffer['expiration_date'])->format('Y-m-d') : '') }}">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Statut</label>
                <select class="form-select" id="status" name="status">
                    @php $statuses = ['active' => 'Active', 'inactive' => 'Inactive', 'draft' => 'Brouillon']; @endphp
                    @foreach ($statuses as $value => $label)
                        <option value="{{ $value }}"
                            {{ old('status', $jobOffer['status'] ?? 'active') === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                {{ isset($jobOffer) ? 'Mettre à jour' : 'Créer l\'offre' }}
            </button>
        </form>
    </div>
@endsection
