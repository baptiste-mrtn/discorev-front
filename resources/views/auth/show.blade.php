@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
    @php
        $isLogin = $tab === 'login';
    @endphp

    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f7f7f7;
        }

        .login-box {
            background-color: #ffffff;
            padding: 2rem;
            width: 500px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .login-logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-logo-img {
            width: 50px;
            height: auto;
        }

        .title {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: #333;
            font-weight: bold;
        }

        .required-fields-note {
            color: red;
            text-align: right;
        }

        .auth-options {
            display: flex;
            justify-content: space-around;
            margin-bottom: 1.5rem;
        }

        .auth-text {
            font-size: 1.2rem;
            cursor: pointer;
            padding-bottom: 5px;
            color: #333;
            text-decoration: none;
            border-bottom: 2px solid transparent;
        }

        .auth-text.active {
            border-bottom: 2px solid #f57c00;
            /* orangish */
        }

        .form-container {
            display: block;
        }

        .input-group {
            margin-bottom: 1.5rem;
        }

        .input-group label {
            font-size: 1rem;
            color: #333;
        }

        .input-group input {
            width: 100%;
            padding: 0.8rem;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .remember-me {
            margin-bottom: 1.5rem;
        }

        .forgot-password-link {
            font-size: 0.9rem;
            color: #f57c00;
            text-decoration: none;
            margin-left: 10px;
        }

        .forgot-password-link:hover {
            text-decoration: underline;
        }

        .social-login .social-btn {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 1rem;
            border: 1px solid #ccc;
            background-color: transparent;
            color: #333;
            font-size: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            cursor: pointer;
        }

        .social-login .social-btn i {
            margin-right: 10px;
        }

        .cta-button-login {
            width: 100%;
            padding: 1rem;
            background-color: #f57c00;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .social-btn.google-btn:hover {
            background-color: #db4437;
            color: white;
        }

        .social-btn.linkedin-btn:hover {
            background-color: #0077b5;
            color: white;
        }

        .checkbox-group {
            margin-bottom: 1rem;
        }

        .checkbox-group label {
            font-size: 0.9rem;
            color: #333;
        }

        .checkbox-group a {
            color: #f57c00;
        }

        .checkbox-group a:hover {
            text-decoration: underline;
        }
    </style>

    <div class="login-container">
        <div class="login-box">
            <div class="login-logo-container">
                <img src="{{ asset('img/logo-dark.png') }}" alt="Logo" class="login-logo-img" />
            </div>
            <div class="title">Bienvenue</div>

            <div class="auth-options">
                <a id="loginTab" href="{{ route('login') }}" class="auth-text {{ $isLogin ? 'active' : '' }}">Connexion</a>
                <a id="registerTab" href="{{ route('register') }}"
                    class="auth-text {{ !$isLogin ? 'active' : '' }}">Inscription</a>
            </div>

            <div class="form-container">
                <div id="loginForm" style="{{ $isLogin ? '' : 'display:none;' }}">
                    @include('auth.login')
                </div>
                <div id="registerForm" style="{{ !$isLogin ? '' : 'display:none;' }}">
                    @include('auth.register')
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const loginTab = document.getElementById('loginTab');
            const registerTab = document.getElementById('registerTab');
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');

            loginTab.addEventListener('click', function(e) {
                e.preventDefault();
                loginTab.classList.add('active');
                registerTab.classList.remove('active');
                loginForm.style.display = 'block';
                registerForm.style.display = 'none';
            });

            registerTab.addEventListener('click', function(e) {
                e.preventDefault();
                registerTab.classList.add('active');
                loginTab.classList.remove('active');
                registerForm.style.display = 'block';
                loginForm.style.display = 'none';
            });
        });
    </script>
@endsection
