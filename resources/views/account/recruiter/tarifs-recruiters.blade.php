@extends('layouts.app')

@section('title', 'Tarifs recruteurs – Discorev')

@section('content')
    <section>
        <x-hero badge="Séduire, inspirer, recruter, fidéliser"
            title="<span class='gradient-text'>Un outil conçu pour faire briller<br>votre entreprise auprès du grand public</span>"
            description="Renforcez votre attractivité auprès de votre public cible et faites de votre culture un atout concurrentiel durable."
            :showImage="true" :showButtons="true" buttonText="Réserver une démo" variant="image-button" />
    </section>

    {{--    <x-companies.section-partners --}}
    {{--        :companies="$companies ?? []" --}}
    {{--        badge="Nos partenaires" --}}
    {{--        title="Ils nous font confiance" --}}
    {{--        buttonText="Découvrir toutes les entreprises" --}}
    {{--        buttonLink="{{ route('companies.index') }}" --}}
    {{--    /> --}}

    <section class="pricing-hero">
        <div class="container">
            <div class="text-center">
                <div class="feature-badge">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" class="me-2">
                        <path fill-rule="evenodd"
                            d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Tarification simple et transparente
                </div>

                <h1 class="display-3 fw-bold mb-4">
                    <span class="gradient-text">Nos offres</span>
                    <span class="gradient-text-orange">recruteur</span>
                </h1>

                <p class="fs-5 mb-0 mx-auto" style="color: var(--text-secondary); line-height: 1.6; max-width: 600px;">
                    Des formules adaptées à tous les besoins, de la découverte à la marque employeur.
                    <br class="d-none d-md-block">
                </p>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($plans as $plan)
                    <div class="{{ $plan->isPremium ? 'col-lg-8' : 'col-md-6 col-lg-3' }}">
                        <x-pricing-card :title="$plan->name" :price="$plan->priceMonth > 0 ? $plan->priceMonth . '€' : $plan->priceYear . '€'" :period="$plan->priceMonth > 0 ? '/mois' : '/an'" :features="$plan->features"
                            :button-text="$plan->isPremium ? 'Contacter l\'équipe' : 'Commencer'" :button-url="route('register')" :is-premium="$plan->isPremium" />
                    </div>
                @endforeach
            </div>

            <div class="row justify-content-center mt-5">
                <div class="col-lg-6">
                    <div class="contact-card text-center">
                        <h3 class="fw-bold mb-3" style="color: var(--indigo);">Des questions sur nos offres ?</h3>
                        <p class="text-muted mb-4">
                            Notre équipe est là pour vous accompagner dans le choix de la formule la plus adaptée à vos
                            besoins.
                        </p>
                        <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                            <a href="mailto:badiss.belhadj.discorev@gmail.com"
                                class="btn btn-primary-gradient d-inline-flex align-items-center">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" class="me-2">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                </svg>
                                badiss.belhadj.discorev@gmail.com
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<style>
    .pricing-hero {
        padding-top: 3rem;
        padding-bottom: 4rem;
    }

    @media (min-width: 992px) {
        .pricing-hero {
            padding-top: 4rem;
        }
    }

    .feature-badge {
        background: rgba(249, 137, 72, 0.15);
        color: var(--orangish);
        border: 1px solid rgba(249, 137, 72, 0.3);
        padding: 8px 16px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 1.5rem;
    }

    .contact-card {
        background: var(--white);
        border: 1px solid var(--wondrous-blue);
        border-radius: 16px;
        padding: 2rem;
    }

    .contact-card a:hover {
        color: var(--sand);
    }
</style>
