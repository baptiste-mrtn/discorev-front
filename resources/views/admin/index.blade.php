@extends('layouts.app')

@section('title', 'Tableau de bord Administrateur')

@section('content')
    <div class="container py-4 pt-5">
        <h1 class="fw-bold mb-4 mt-5">Bienvenue, {{ $user['firstName'] }} 👋</h1>

        <div class="row g-4">
            @if ($user['permissions']['manageJobs'] === true)
                <div class="col-12 col-md-4">
                    <x-dashboard-card icon="package" title="Gestion des offres d'emplois" :count="$offers?->count() ?? '0'" :subtitle="$offers->where('status', 'active')->count() . ' actives'"
                        :link="route('admin.offers.index')" color="primary" />
                </div>
            @endif
            @if ($user['permissions']['manageUsers'] === true)
                <div class="col-12 col-md-4">
                    <x-dashboard-card icon="groups" title="Gestion des utilisateurs" :count="$users?->count() ?? '0'" :subtitle="$users->where('createdAt', today())->count()
                        ? $users->where('createdAt', today())->count() . ' nouveaux inscrits'
                        : 'Aucun nouvel inscrit'"
                        link="
                 {{ route('admin.users.index') }}
                " color="secondary" />
                </div>
            @endif
            @if ($user['permissions']['manageJobs'] === true)
                <div class="col-12 col-md-4">
                    <x-dashboard-card icon="credit_card" title="Abonnements" :count="$subscriptions?->count() ?? '0'" :subtitle="$subscriptions->where('status', 'active')->count() . ' actifs'"
                        link="
                {{-- {{ route('admin.subscriptions.index') }} --}}
                " color="info" />
                </div>
            @endif
            @if ($user['permissions']['manageJobs'] === true)
                <div class="col-12 col-md-4">
                    <x-dashboard-card icon="payments" title="Paiements récents" :count="$payments->count()" :subtitle="$payments->last()
                        ? 'Dernier: ' . $payments->last()->amount . ' ' . $payments->last()->currency
                        : 'Aucun paiement'"
                        link="
                {{-- {{ route('admin.payments.index') }} --}}
                " color="success" />
                </div>
            @endif
            @if ($user['permissions']['manageAdmins'] === true)
                <div class="col-12 col-md-4">
                    <x-dashboard-card icon="shield_person" title="Administrateurs" count="{{ $admins->count() }}"
                        subtitle="{{ $admins->where('role', 'super-admin')->count() }} super admin(s)"
                        link="
                {{ route('admin.admins.index') }}
                " color="danger" />
                </div>
            @endif
            @if ($user['permissions']['manageLogs'] === true)
                <div class="col-12 col-md-4">
                    <x-dashboard-card icon="history" title="Historique des actions"
                        subtitle="Dernière action : {{ $history->last()->details ?: $history->last()->actionType . ' de ' . $users->firstWhere('id', $history->last()->userId)->firstName . ' ' . $users->firstWhere('id', $history->last()->userId)->lastName }}"
                        link="
                {{ route('admin.logs.index') }}
                " color="grey" />
                </div>
            @endif
            @if ($user['permissions']['managePremium'] === true)
                <div class="col-12 col-md-4">
                    <x-dashboard-card icon="diamond" title="Offres Premium" subtitle="Modifier les offres premium"
                        link="
                {{ route('admin.plans.index') }}
                " color="warning" />
                </div>
            @endif
            @if ($user['permissions']['manageTags'] === true)
                <div class="col-12 col-md-4">
                    @php
                        $allTags = $tagCategories->flatMap(fn($category) => $category->tags);
                        $totalTags = $allTags->count();
                        $pendingTags = $allTags->where('approved', false)->count();
                    @endphp

                    <x-dashboard-card icon="tag" title="Tags" :count="$totalTags" :subtitle="$pendingTags . ' à approuver'"
                        link="
                {{ route('admin.tags.index') }}
                " color="dark" />
                </div>
            @endif
        </div>
    </div>
@endsection
