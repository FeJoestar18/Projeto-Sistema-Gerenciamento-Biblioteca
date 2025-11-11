@extends('layouts.system')

@section('title', 'Cadastro')

@section('content')
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>📝 Cadastro</h1>
                <p>Crie sua conta no sistema</p>
            </div>

            <div class="auth-form">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nome Completo *</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name"
                            autofocus placeholder="Seu nome completo">
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail *</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                            placeholder="seu@email.com">
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="cpf">CPF (opcional)</label>
                            <input id="cpf" type="text" name="cpf" value="{{ old('cpf') }}" maxlength="11"
                                placeholder="Apenas números">
                            @error('cpf')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="rg">RG (opcional)</label>
                            <input id="rg" type="text" name="rg" value="{{ old('rg') }}" placeholder="Seu RG">
                            @error('rg')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cnpj">CNPJ (opcional)</label>
                        <input id="cnpj" type="text" name="cnpj" value="{{ old('cnpj') }}" maxlength="14"
                            placeholder="Apenas números">
                        <small>Preencha apenas se for empresa</small>
                        @error('cnpj')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Senha *</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            placeholder="Mínimo 6 caracteres">
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Confirmar Senha *</label>
                        <input id="password-confirm" type="password" name="password_confirmation" required
                            autocomplete="new-password" placeholder="Repita a senha">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-block">
                            Cadastrar
                        </button>
                    </div>

                    <div class="auth-links">
                        <a href="{{ route('login') }}">
                            Já tem uma conta? <strong>Faça login</strong>
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
            max-width: 550px;
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

        .auth-form .form-group small {
            color: var(--text-light);
            font-size: 0.85rem;
            display: block;
            margin-top: 0.25rem;
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