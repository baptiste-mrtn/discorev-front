@extends('layouts.app')

@section('title', 'Administrateur | Admins')

@section('content')
    <script src="//unpkg.com/alpinejs" defer></script>

    <div class="container py-4 pt-5">
        <h1 class="fw-bold mb-4 mt-5">Administrateur | Admins</h1>
        @php
            use App\Models\Api\Admin;
        @endphp

        <div class="list-group">
            @foreach ($admins as $admin)
                @php
                    $isSuperAdmin = ($admin->role ?? null) === 'super-admin';

                    $permissions = $isSuperAdmin
                        ? array_fill_keys(array_keys(Admin::PERMISSIONS_LABELS), true)
                        : $admin->permissions ?? [];
                @endphp
                <div class="list-group-item py-3 px-4 shadow-sm border-0 mb-3 rounded-3" x-data="{ edit: false }">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-muted small">{{ 'Créé le: ' . date('d/m/Y - H:i', strtotime($admin->createdAt)) }}
                        </p>
                        <p class="text-muted small">
                            {{ 'Dérnière modif: ' . date('d/m/Y - H:i', strtotime($admin->updatedAt)) }}</p>
                    </div>
                    {{-- VIEW MODE --}}
                    <template x-if="!edit">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">

                            <div class="me-3" style="min-width: 150px;">
                                <div class="fw-bold fs-5">
                                    {{ $admin->user->firstName ?? 'Prénom inconnu' }}
                                    {{ $admin->user->lastName ?? 'Nom inconnu' }}
                                </div>
                            </div>

                            <div class="small me-3" style="min-width: 150px;">
                                @foreach (\App\Models\Api\Admin::ROLES as $key => $label)
                                    <div class="col-12 col-md-6">
                                        @if ($admin->role === $key)
                                            {{ $label }}
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            <div class="row g-1 small" style="min-width: 200px;">
                                @foreach (\App\Models\Api\Admin::PERMISSIONS_LABELS as $key => $label)
                                    <div class="col-12 col-md-6">
                                        @if ($admin->permissions[$key] === true)
                                            ✅
                                        @else
                                            ❌
                                        @endif
                                        {{ $label }}
                                    </div>
                                @endforeach
                            </div>

                            <div class="text-center me-3" style="min-width: 100px;">
                                @if ($admin->status === true)
                                    <span class="badge bg-success">
                                        Actif
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        Désactivé
                                    </span>
                                @endif
                            </div>

                            <div class="d-flex gap-2">
                                <button type="button"
                                    class="btn btn-warning p-2 rounded-circle d-flex align-items-center justify-content-center"
                                    style="width:38px;height:38px;" @click="edit = true" @disabled($isSuperAdmin)>
                                    <i class="material-symbols-outlined">edit</i>
                                </button>

                                <form action="{{ route('admin.admins.delete', $admin->id) }}" method="POST"
                                    onsubmit="return confirm('Supprimer cet admin ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="btn btn-danger p-2 rounded-circle d-flex align-items-center justify-content-center"
                                        style="width:38px;height:38px;" @disabled($isSuperAdmin)>
                                        <i class="material-symbols-outlined">delete</i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </template>

                    {{-- EDIT MODE --}}
                    <template x-if="edit">
                        <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST"
                            class="row gx-2 gy-2 align-items-end">
                            @csrf
                            @method('PUT')

                            <div class="me-3" style="min-width: 150px;">
                                <div class="fw-bold fs-5">
                                    {{ $admin->user->firstName ?? 'Prénom inconnu' }}
                                    {{ $admin->user->lastName ?? 'Nom inconnu' }}
                                </div>
                            </div>

                            {{-- RÔLE --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Rôle</label>
                                <select name="role" class="form-select" @disabled($isSuperAdmin)>
                                    @foreach (Admin::ROLES as $value => $label)
                                        <option value="{{ $value }}" @selected(($admin->role ?? '') === $value)>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>

                                @if ($isSuperAdmin)
                                    <input type="hidden" name="role" value="super-admin">
                                @endif
                            </div>

                            {{-- PERMISSIONS --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Permissions</label>
                                <div class="d-flex justify-content-around align-items-center">

                                    <button @disabled($isSuperAdmin) type="button"
                                        class="btn btn-sm btn-outline-secondary mb-2"
                                        onclick="document.querySelectorAll('[name^=permissions]').forEach(cb => cb.checked = true)">
                                        Tout cocher
                                    </button>

                                    <button @disabled($isSuperAdmin) type="button"
                                        class="btn btn-sm btn-outline-secondary mb-2"
                                        onclick="document.querySelectorAll('[name^=permissions]').forEach(cb => cb.checked = false)">
                                        Tout décocher
                                    </button>
                                </div>

                                <div class="row g-2">
                                    @foreach (Admin::PERMISSIONS_LABELS as $key => $label)
                                        @php
                                            $checked = $permissions[$key] ?? false;
                                        @endphp

                                        <div class="col-12 col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    name="permissions[{{ $key }}]" id="perm_{{ $key }}"
                                                    value="1" @checked($checked)
                                                    @disabled($isSuperAdmin)>

                                                <label class="form-check-label" for="perm_{{ $key }}">
                                                    {{ $label }}
                                                    @if ($isSuperAdmin)
                                                        <span class="badge bg-warning text-dark ms-1">Super admin</span>
                                                    @endif
                                                </label>
                                            </div>

                                            {{-- fallback submit si disabled --}}
                                            @if ($isSuperAdmin)
                                                <input type="hidden" name="permissions[{{ $key }}]"
                                                    value="1">
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small fw-semibold mb-1">
                                    Statut du compte
                                </label>
                                @if ($isSuperAdmin)
                                    <span class="badge bg-success">Toujours actif</span>
                                @else
                                    {{-- badge-switch --}}
                                    <span id="statusBadge{{ $admin->id }}"
                                        class="badge rounded-pill cursor-pointer {{ $admin->status ? 'bg-success' : 'bg-secondary' }}"
                                        data-status="{{ $admin->status ? 1 : 0 }}"
                                        onclick="toggleStatus({{ $admin->id }})" style="cursor: pointer;">
                                        {{ $admin->status ? 'Actif' : 'Désactivé' }}
                                    </span>
                                @endif
                                {{-- champ caché pour le formulaire --}}
                                <input type="hidden" name="status" id="statusInput{{ $admin->id }}"
                                    value="{{ $admin->status ? 1 : 0 }}">
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

    <script>
        function toggleStatus(adminId) {
            const badge = document.getElementById(`statusBadge${adminId}`);
            const input = document.getElementById(`statusInput${adminId}`);

            const isActive = badge.dataset.status === '1';

            // toggle
            badge.dataset.status = isActive ? '0' : '1';
            input.value = isActive ? '0' : '1';

            // UI
            badge.classList.toggle('bg-success', !isActive);
            badge.classList.toggle('bg-danger', isActive);
            badge.textContent = isActive ? 'Désactivé' : 'Actif';
        }
    </script>

@endsection
