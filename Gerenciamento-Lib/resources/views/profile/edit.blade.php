@extends('layouts.system')

@section('title', 'Editar Perfil')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>✏️ Editar Perfil</h1>
            <a href="{{ route('profile.show') }}" class="btn btn-secondary">
                ← Voltar ao Perfil
            </a>
        </div>

        <div class="edit-forms">
            <div class="form-section">
                <h2>Informações Pessoais</h2>
                <form action="{{ route('profile.update') }}" method="POST" class="profile-form">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            ✓ Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>

            <div class="form-section">
                <h2>Alterar Senha</h2>
                <form action="{{ route('profile.updatePassword') }}" method="POST" class="password-form">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="current_password">Senha Atual</label>
                        <input type="password" id="current_password" name="current_password" required>
                        @error('current_password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Nova Senha</label>
                        <input type="password" id="password" name="password" required>
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Nova Senha</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">
                            🔒 Alterar Senha
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .edit-forms {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-top: 2rem;
        }

        .form-section {
            background: linear-gradient(135deg, var(--medium-gray) 0%, var(--light-gray) 100%);
            border: 1px solid rgba(196, 30, 58, 0.3);
            border-radius: 8px;
            padding: 2rem;
        }

        .form-section h2 {
            margin: 0 0 1.5rem 0;
            color: var(--primary-red);
            font-size: 1.5rem;
            font-weight: 600;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        @media (max-width: 768px) {
            .edit-forms {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .page-header {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
@endsection