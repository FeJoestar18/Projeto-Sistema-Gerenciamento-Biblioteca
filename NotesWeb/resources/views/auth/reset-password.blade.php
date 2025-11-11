@extends('layouts.system')

@section('title', 'Redefinir Senha')

@section('content')
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>🔐 Nova Senha</h1>
                <p>Digite sua nova senha</p>
            </div>

            <div class="auth-form">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required
                            autocomplete="email" readonly>
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Nova Senha</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            placeholder="Mínimo 6 caracteres">
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Confirmar Senha</label>
                        <input id="password-confirm" type="password" name="password_confirmation" required
                            autocomplete="new-password" placeholder="Repita a senha">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-block">
                            Redefinir Senha
                        </button>
                    </div>

                    <div class="auth-links">
                        <a href="{{ route('login') }}">
                            ← Voltar para o Login
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

        .btn-block {
            width: 100%;
            padding: 0.75rem;
        }

        .auth-links {
            text-align: center;
            margin-top: 1.5rem;
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