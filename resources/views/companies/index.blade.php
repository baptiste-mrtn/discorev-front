<section class="explore-companies">
    <div class="container">
        <h2>Explorer les entreprises</h2>
        <h4>Découvrez des entreprises qui recrutent activement dans le secteur social.</h4>

        <div class="row gy-4 mt-4 mb-5">
            @foreach ($companies as $company)
                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                    <div class="company-card">
                        <img src="{{ asset($company->image) }}" alt="{{ $company->name }}">
                        <h3>{{ $company->name }}</h3>
                        <p>{{ $company->description }}</p>
                        <a class="cta-link" href="{{ route('companies.show', $company->slug) }}">
                            +{{ $company->offers_count }} offres
                        </a>
                        <div class="card-icon"><i class="fas fa-arrow-right"></i></div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <a href="#" class="cta-button-transparent">Voir plus d'entreprises</a>
        </div>
    </div>
</section>
