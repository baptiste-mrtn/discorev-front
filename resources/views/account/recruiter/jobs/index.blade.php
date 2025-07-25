@extends('layouts.app')

@section('title', 'Liste des offres')

@section('content')

    <section id="offers-list-container" class="offers-list-container">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end">
                <h1>Mes offres créees</h1>
                <a href="{{ route('recruiter.jobs.create') }}" class="btn btn-priamry">Ajouter une offre</a>
            </div>
            <div id="offers-list" class="offers-list">
                @if (!empty($offers) && count($offers))
                    @foreach ($offers as $offer)
                        <div class="offer-card">
                            <h3>{{ $offer['title'] }}</h3>
                            <p>{{ $offer['location'] }}</p>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="{{ route('job_offers.show', $offer['id']) }}" class="btn btn-link">Voir l'offre
                                        (candidat)
                                    </a>
                                </div>
                                <div>
                                    <a href="{{ route('recruiter.jobs.edit', $offer['id']) }}"
                                        class="btn btn-warning">Modifier
                                        l'offre</a>
                                    <form action="{{ route('recruiter.jobs.destroy', $offer['id']) }}" method="POST"
                                        style="display: inline;" id="delete-offer-form-{{ $offer['id'] }}">
                                        @csrf
                                        @method('DELETE')
                                        <a href="#" class="btn btn-danger delete-offer-btn"
                                            data-offer-id="{{ $offer['id'] }}">Supprimer l'offre</a>
                                    </form>
                                </div>


                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Aucune offre trouvée.</p>
                @endif
            </div>
        </div>
    </section>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-offer-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var offerId = btn.getAttribute('data-offer-id');
                if (confirm('Êtes-vous sûr de vouloir supprimer cette offre ?')) {
                    document.getElementById('delete-offer-form-' + offerId).submit();
                }
            });
        });
    });
</script>
