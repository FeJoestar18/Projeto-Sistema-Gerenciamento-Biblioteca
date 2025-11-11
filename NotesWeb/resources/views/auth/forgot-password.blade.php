@extends('layouts.system')

@section('title', 'Esqueci minha senha')

@section('content')
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>🔑 Recuperar Senha</h1>
                <p>Digite seu e-mail para receber o link de recuperação</p>
            </div>

            <div class="auth-form">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                            autofocus placeholder="seu@email.com">
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-block">
                            Enviar Link de Recuperação
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