@extends('layouts.app')

@section('title', 'Administrateur | Tags')

@section('content')
    <script src="//unpkg.com/alpinejs" defer></script>

    <div class="container py-4 pt-5">
        <h1 class="fw-bold mb-4 mt-5">Administrateur | Tags</h1>

        <div class="row g-1 small">
            @foreach ($tagCategories as $category)
                <div class="col-12 col-md-6 mb-2">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="text-light">{{ $category->name }}</h6>
                                <span class="text-light text-muted">({{ $category->slug }})</span>
                            </div>
                        </div>
                        <div class="list-group">
                            @foreach ($category->tags as $tag)
                                <div class="list-group-item d-flex justify-content-between align-items-center flex-wrap"
                                    x-data="tagApproval({{ $tag->id }}, {{ $tag->approved ? 'true' : 'false' }})">
                                    <div class="d-flex align-items-center flex-wrap">
                                        <p class="mb-0 fw-semibold me-2">{{ $tag->name }}</p>
                                        <p class="mb-0 text-muted">({{ $tag->slug }})</p>
                                    </div>

                                    <div class="text-center me-3" style="min-width: 120px;">
                                        <span class="badge" style="cursor: pointer"
                                            :class="approved ? 'bg-success' : 'bg-danger'" @click="toggle()">
                                            <template x-if="loading">⏳</template>
                                            <template x-if="!loading">
                                                <span x-text="approved ? 'Approuvé' : 'Non approuvé'"></span>
                                            </template>
                                        </span>

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        window.App = {
            apiUrl: "{{ config('app.api') }}",
            token: "{{ session('accessToken') }}"
        };

        function tagApproval(tagId, initialState) {
            return {
                approved: initialState,
                loading: false,

                async toggle() {
                    if (this.loading) return;

                    const previous = this.approved;
                    this.approved = !this.approved; // 🔥 update immédiate
                    this.loading = true;

                    try {
                        const response = await fetch(
                            `${App.apiUrl}/tags/${tagId}/approve`, {
                                method: 'PATCH',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Authorization': `Bearer ${App.token}`
                                }
                            }
                        );

                        if (!response.ok) throw new Error();

                        const data = await response.json();
                        this.approved = data.approved; // sync API
                    } catch (e) {
                        this.approved = previous; // rollback
                        alert('Erreur lors de la mise à jour');
                    } finally {
                        this.loading = false;
                    }
                }
            }
        }
    </script>
@endsection
