@extends('layouts.app')

@section('title', 'Administrateur | Utilisateurs')

@section('content')
    <script src="//unpkg.com/alpinejs" defer></script>

    <div class="container py-4 pt-5">
        <h1 class="fw-bold mb-4 mt-5">Administrateur | Utilisateurs</h1>

        <div class="list-group">

            @foreach ($users as $userApi)
                <div class="list-group-item py-3 px-4 shadow-sm border-0 mb-3 rounded-3" x-data="{ edit: false }">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-muted small">{{ 'Créé le: ' . date('d/m/Y - H:i', strtotime($userApi->createdAt)) }}
                        </p>
                        <p class="text-muted small">
                            {{ 'Dérnière modif: ' . date('d/m/Y - H:i', strtotime($userApi->updatedAt)) }}</p>
                    </div>
                    {{-- VIEW MODE --}}
                    <template x-if="!edit">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">

                            <div class="me-3" style="min-width: 150px;">
                                <div class="fw-bold fs-5">
                                    {{ $userApi->firstName ?? 'Prénom inconnu' }}
                                    {{ $userApi->lastName ?? 'Nom inconnu' }}
                                </div>
                            </div>

                            <div class="small me-3" style="min-width: 150px;">
                                {{ $userApi->email ?? '-' }}
                            </div>

                            <div class="small me-3" style="min-width: 120px;">
                                {{ $userApi->phoneNumber ?? '-' }}
                            </div>

                            <div class="text-center small me-3" style="min-width: 100px;">
                                @if ($userApi->accountType === 'candidate')
                                    <span class="badge bg-info ms-1">Candidat</span>
                                @elseif ($userApi->accountType === 'recruiter')
                                    <span class="badge bg-primary ms-1">Recruteur</span>
                                @else
                                    <span class="badge bg-warning ms-1">Admin</span>
                                @endif
                            </div>

                            <div class="text-center me-3" style="min-width: 100px;">
                                <span
                                    class="badge
                                @if ($userApi->newsletter === true) bg-success
                                @else bg-danger @endif">
                                    Newsletter
                                </span>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="button"
                                    class="btn btn-warning p-2 rounded-circle d-flex align-items-center justify-content-center"
                                    style="width:38px;height:38px;" @click="edit = true">
                                    <i class="material-symbols-outlined">edit</i>
                                </button>

                                <form action="{{ route('admin.users.delete', $userApi->id) }}" method="POST"
                                    onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="btn btn-danger p-2 rounded-circle d-flex align-items-center justify-content-center"
                                        style="width:38px;height:38px;">
                                        <i class="material-symbols-outlined">delete</i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </template>

                    {{-- EDIT MODE --}}
                    <template x-if="edit">
                        <form action="{{ route('admin.users.update', $userApi->id) }}" method="POST"
                            class="row gx-2 gy-2 align-items-end">
                            @csrf
                            @method('PUT')

                            <div class="col-md-3">
                                <label class="form-label small mb-1">Prénom</label>
                                <input name="firstName" type="text" class="form-control form-control-sm"
                                    value="{{ $userApi->firstName }}" required>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small mb-1">Nom</label>
                                <input name="lastName" type="text" class="form-control form-control-sm"
                                    value="{{ $userApi->lastName }}" required>
                            </div>

                            <div class="col-md-1">
                                <label class="form-label small mb-1">Email</label>
                                <input name="email" type="email" class="form-control form-control-sm"
                                    value="{{ $userApi->email }}">
                            </div>

                            <div class="col-md-1">
                                <label class="form-label small mb-1">Téléphone</label>
                                <input name="phoneNumber" type="text" class="form-control form-control-sm"
                                    value="{{ $userApi->phoneNumber }}">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small mb-1">Newsletter</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="newsletter" type="checkbox" value="1"
                                        id="newsletter{{ $userApi->id }}"
                                        @if ($userApi->newsletter) checked @endif>
                                    <label class="form-check-label small"
                                        for="newsletter{{ $userApi->id }}">Newsletter</label>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end gap-2 mt-1">
                                <button type="button" class="btn btn-sm btn-secondary"
                                    @click="edit = false">Cancel</button>
                                <button type="submit" class="btn btn-sm btn-success">Save</button>
                            </div>

                        </form>
                    </template>
                </div>
            @endforeach
        </div>
    </div>
@endsection
