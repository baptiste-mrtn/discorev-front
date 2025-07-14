<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Discorev')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/js/app.js', 'resources/scss/app.scss'])
</head>

<body>

    @include('partials.navbar')

    {{-- Zone principale --}}
    <main class="mt-6">
        {{-- Toast messages --}}
        <div aria-live="polite" aria-atomic="true" class="position-relative">
            <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100;">
                <x-toasts />
            </div>
        </div>
        {{-- Contenu principal --}}
        @yield('content')

        @include('partials.footer')
    </main>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastElList = [].slice.call(document.querySelectorAll('.toast'));
            toastElList.forEach(function(toastEl) {
                const toast = new bootstrap.Toast(toastEl);
                toast.show();
            });
        });
    </script>
    @vite(['resources/js/app.js', 'resources/scss/app.scss'])
</body>

</html>
