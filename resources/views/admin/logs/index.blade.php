@extends('layouts.app')

@section('title', 'Administrateur | Historique')

@section('content')
    <script src="//unpkg.com/alpinejs" defer></script>

    <div class="container py-4 pt-5">
        <h1 class="fw-bold mb-4 mt-5">Administrateur | Historique</h1>

        <div class="list-group">

            @foreach ($histories as $history)
                <div class="list-group-item py-3 px-4 shadow-sm border-0 mb-3 rounded-3">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-2">
                            <small class="text-muted">
                                {{ date('d/m/Y - H:i', strtotime($history->createdAt)) }}
                            </small>
                        </div>
                        <div class="col-12 col-md-6 col-lg-1">
                            <span class="mb-1">
                                {{ $history->user->id }}
                            </span>
                        </div>
                        <div class="col-12 col-md-6 col-lg-2">
                            <h6 class="mb-1">
                                {{ $history->user->firstName . ' ' . $history->user->lastName ?? 'Utilisateur inconnu' }}
                            </h6>
                        </div>
                        <div class="col-12 col-md-6 col-lg-1">
                            <span class="mb-1">
                                {{ $history->user->accountType }}
                            </span>
                        </div>
                        <div class="col-12 col-md-4">
                            <p class="text-break">{{ $history->details ?? 'Pas de détails' }}</p>
                        </div>
                        <div class="col-12 col-md-6 col-lg-2">
                            <span
                                class="badge 
                            @switch($history->action_type)
                                @case('create') bg-success @break
                                @case('update') bg-warning text-dark @break
                                @case('delete') bg-danger @break
                                @case('view') bg-info text-dark @break
                                @case('login') bg-primary @break
                                @case('logout') bg-secondary @break
                                @default bg-dark
                            @endswitch
                        ">
                                {{ ucfirst($history->actionType) }}
                            </span>
                            <span class="badge bg-secondary">
                                {{ ucfirst(str_replace('_', ' ', $history->relatedType)) }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
