@extends('layouts.system')

@section('title', 'Login')

@section('content')
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>🔐 Login</h1>
                <p>Acesse o Sistema de Gerenciamento de Biblioteca</p>
            </div>

            <div class="auth-form">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                            autofocus placeholder="seu@email.com">
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            placeholder="••••••••">
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="remember-me">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Lembrar de mim</label>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-block">
                            Entrar
                        </button>
                    </div>

                    <div class="auth-links">
                        <a href="{{ route('register') }}">
                            Não tem uma conta? <strong>Cadastre-se</strong>
                        </a>
                        <a href="{{ route('password.request') }}">
                            Esqueceu sua senha?
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .auth-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 70vh;
            padding: 2rem;
        }

        .auth-card {
            background-color: var(--medium-gray);
            border: 1px solid rgba(196, 30, 58, 0.3);
            border-radius: 8px;
            padding: 2rem;
            max-width: 450px;
            width: 100%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-header h1 {
            color: var(--white);
            margin-bottom: 0.5rem;
        }

        .auth-header p {
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .auth-form .form-group {
            margin-bottom: 1.5rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .remember-me label {
            color: var(--text-light);
            font-weight: normal;
        }

        .btn-block {
            width: 100%;
            padding: 0.75rem;
        }

        .auth-links {
            text-align: center;
            margin-top: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .auth-links a {
            color: var(--primary-red);
            text-decoration: none;
            font-size: 0.95rem;
        }

        .auth-links a:hover {
            color: var(--light-red);
        }
    </style>
@endsection