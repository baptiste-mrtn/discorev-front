<div>
    @php
        $types = [
            'success' => 'bg-success text-white',
            'error' => 'bg-danger text-white',
            'errors' => 'bg-danger text-white',
            'warning' => 'bg-warning text-dark',
            'info' => 'bg-info text-dark',
        ];
    @endphp

    @foreach ($types as $type => $classes)
        @if (session($type) || ($type === 'errors' && $errors->any()))
            <div class="toast align-items-center {{ $classes }} border-0 position-fixed top-0 end-0 m-3"
                role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000" data-bs-autohide="true">
                <div class="d-flex">
                    <div class="toast-body">
                        @if ($type === 'errors')
                            {{ $errors->first() }}
                        @else
                            {{ session($type) }}
                        @endif
                    </div>
                    <button type="button"
                        class="btn-close {{ str_contains($classes, 'text-white') ? 'btn-close-white' : '' }} me-2 m-auto"
                        data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif
    @endforeach
</div>
