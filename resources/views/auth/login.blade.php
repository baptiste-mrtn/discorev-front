<form method="POST" action="{{ route('login.submit') }}">
    @csrf

    <div class="mb-3">
        <label for="email">Email <span class="text-danger">*</span></label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ old('email') }}" required autofocus>
        @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password">Mot de passe <span class="text-danger">*</span></label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
            name="password" required>
        @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Se souvenir de moi</label>
        </div>
        <a href="#" class="forgot-password-link">Mot de passe oublié ?</a>
    </div>

    <button type="submit" class="btn cta-button-login">Se connecter</button>
</form>
