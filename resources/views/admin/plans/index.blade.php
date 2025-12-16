@extends('layouts.app')

@section('title', 'Administrateur | Plans')

@section('content')
    <script src="//unpkg.com/alpinejs" defer></script>

    <div class="container py-4 pt-5">
        <h1 class="fw-bold mb-4 mt-5">Administrateur | Plans</h1>
        <div x-data="{ showCreate: false }">
            <!-- Bouton Créer -->
            <div class="mb-3">
                <button class="btn btn-success" @click="showCreate = true">Créer un plan</button>
            </div>

            <!-- Formulaire Création -->
            <div x-show="showCreate" class="mb-4">
                <form action="{{ route('admin.plans.create') }}" method="POST"
                    class="row gx-2 gy-2 align-items-end shadow-sm p-3 rounded">
                    @csrf

                    <div class="col-md-3">
                        <label class="form-label small">Nom</label>
                        <input name="name" type="text" class="form-control form-control-sm" required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small">Prix / mois</label>
                        <input name="priceMonth" type="number" step="0.01" class="form-control form-control-sm">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small">Prix / an</label>
                        <input name="priceYear" type="number" step="0.01" class="form-control form-control-sm">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small">Crédits</label>
                        <input name="credits" type="text" class="form-control form-control-sm">
                    </div>

                    <div class="col-md-1">
                        <label class="form-label small">Durée (h)</label>
                        <input name="adDurationHours" type="number" class="form-control form-control-sm" value="48">
                    </div>

                    <div class="col-12">
                        <label class="form-label small">Features</label>
                        <div x-data="{ features: [''] }">
                            <template x-for="(feature, index) in features" :key="index">
                                <div class="d-flex gap-2 mb-1">
                                    <input type="text" class="form-control form-control-sm" :name="`features[${index}]`"
                                        x-model="features[index]">
                                    <button type="button" class="btn btn-sm btn-danger"
                                        @click="features.splice(index, 1)">✕</button>
                                </div>
                            </template>
                            <button type="button" class="btn btn-sm btn-outline-primary mt-1" @click="features.push('')">+
                                Ajouter une feature</button>
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end gap-2 mt-2">
                        <button type="button" class="btn btn-sm btn-secondary" @click="showCreate = false">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-success">Créer</button>
                    </div>
                </form>
            </div>
        </div>


        <div class="list-group">
            @foreach ($plans as $plan)
                <div class="list-group-item py-3 px-4 shadow-sm border-0 mb-3 rounded-3" x-data="{ edit: false }">

                    {{-- META --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-muted small">
                            Créé le : {{ $plan->createdAt?->format('d/m/Y H:i') }}
                        </p>
                        <p class="text-muted small">
                            Dernière modif : {{ $plan->updatedAt?->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    {{-- VIEW MODE --}}
                    <template x-if="!edit">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                            <div style="min-width: 160px;">
                                <div class="fw-bold fs-5">{{ $plan->name }}</div>
                                @if ($plan->isPremium)
                                    <span class="badge bg-warning text-dark">Premium</span>
                                @endif
                            </div>

                            <div class="small" style="min-width: 120px;">
                                @if ($plan->priceMonth > 0)
                                    {{ $plan->priceMonth }} € / mois
                                @else
                                    {{ $plan->priceYear }} € / an
                                @endif
                            </div>

                            <div class="small" style="min-width: 120px;">
                                {{ $plan->credits ?? '-' }}
                            </div>

                            <div class="small" style="min-width: 100px;">
                                {{ $plan->adDurationHours }} h
                            </div>

                            <div>
                                <span class="badge {{ $plan->isActive ? 'bg-success' : 'bg-danger' }}">
                                    {{ $plan->isActive ? 'Actif' : 'Inactif' }}
                                </span>
                            </div>

                            <div class="d-flex gap-2">
                                <button class="btn btn-warning p-2 rounded-circle" style="width:38px;height:38px;"
                                    @click="edit = true">
                                    <i class="material-symbols-outlined">edit</i>
                                </button>
                            </div>

                        </div>
                    </template>

                    {{-- EDIT MODE --}}
                    <template x-if="edit">
                        <form action="{{ route('admin.plans.update', $plan->id) }}" method="POST"
                            class="row gx-2 gy-2 align-items-end">
                            @csrf
                            @method('PUT')

                            <div class="col-md-3">
                                <label class="form-label small">Nom</label>
                                <input name="name" class="form-control form-control-sm" value="{{ $plan->name }}"
                                    required>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label small">Prix / mois</label>
                                <input name="priceMonth" type="number" step="0.01" class="form-control form-control-sm"
                                    value="{{ $plan->priceMonth }}">
                            </div>

                            <div class="col-md-2">
                                <label class="form-label small">Prix / an</label>
                                <input name="priceYear" type="number" step="0.01"
                                    class="form-control form-control-sm" value="{{ $plan->priceYear }}">
                            </div>

                            <div class="col-md-2">
                                <label class="form-label small">Crédits</label>
                                <input name="credits" class="form-control form-control-sm" value="{{ $plan->credits }}">
                            </div>

                            <div class="col-md-1">
                                <label class="form-label small">Durée (h)</label>
                                <input name="adDurationHours" type="number" class="form-control form-control-sm"
                                    value="{{ $plan->adDurationHours }}">
                            </div>

                            <div class="col-md-1">
                                <label class="form-label small">Actif</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="isActive" type="checkbox" value="1"
                                        @checked($plan->isActive)>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label small">Features</label>

                                <div x-data="{ features: @js($plan->features ?? []) }">
                                    <template x-for="(feature, index) in features" :key="index">
                                        <div class="d-flex gap-2 mb-1">
                                            <input type="text" class="form-control form-control-sm"
                                                :name="`features[${index}]`" x-model="features[index]">

                                            <button type="button" class="btn btn-sm btn-danger"
                                                @click="features.splice(index, 1)">
                                                ✕
                                            </button>
                                        </div>
                                    </template>

                                    <button type="button" class="btn btn-sm btn-outline-primary mt-1"
                                        @click="features.push('')">
                                        + Ajouter une feature
                                    </button>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end gap-2 mt-2">
                                <button type="button" class="btn btn-sm btn-secondary" @click="edit = false">
                                    Cancel
                                </button>
                                <button type="submit" class="btn btn-sm btn-success">
                                    Save
                                </button>
                            </div>

                        </form>
                    </template>

                </div>
            @endforeach

        </div>
    </div>
@endsection
