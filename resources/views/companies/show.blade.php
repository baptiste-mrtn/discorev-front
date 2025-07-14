<section class="company-profile">
    <div class="container">
        <h1>{{ $company->name }}</h1>
        <img src="{{ asset($company->image) }}" alt="{{ $company->name }}">
        <p>{{ $company->description }}</p>
        <p><strong>{{ $company->offers_count }} offres à pourvoir</strong></p>

        <a href="{{ route('companies.index') }}" class="btn btn-secondary mt-3">← Retour aux entreprises</a>
    </div>
</section>
