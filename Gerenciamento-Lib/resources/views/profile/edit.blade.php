@extends('layouts.system')

@section('title', 'Editar Perfil')

@section('content')
    <div class="edit-profile-container">
        <div class="edit-profile-header">
            <div class="header-content">
                <div class="header-icon">
                    <i class="fas fa-user-edit"></i>
                </div>
                <div class="header-text">
                    <h1 class="page-title">Editar Perfil</h1>
                    <p class="page-subtitle">Atualize suas informações pessoais e configurações</p>
                </div>
            </div>
            <a href="{{ route('profile.show') }}" class="btn btn-secondary btn-modern">
                <i class="fas fa-arrow-left"></i>
                Voltar ao Perfil
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="edit-forms-grid">
            <div class="form-card">
                <div class="form-card-header">
                    <div class="card-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="card-title">
                        <h2>Informações Pessoais</h2>
                        <p>Atualize seus dados básicos</p>
                    </div>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" class="modern-form">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name" class="form-label">Nome Completo</label>
                        <div class="input-with-icon">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" id="name" name="name" class="form-control @error('name') error @enderror"
                                value="{{ old('name', $user->name) }}" required placeholder="Digite seu nome completo">
                        </div>
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" id="email" name="email" class="form-control @error('email') error @enderror"
                                value="{{ old('email', $user->email) }}" required placeholder="seu.email@exemplo.com">
                        </div>
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-large">
                            <i class="fas fa-save"></i>
                            Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>

            <div class="form-card">
                <div class="form-card-header">
                    <div class="card-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="card-title">
                        <h2>Alterar Senha</h2>
                        <p>Mantenha sua conta segura</p>
                    </div>
                </div>

                <form action="{{ route('profile.updatePassword') }}" method="POST" class="modern-form">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="current_password" class="form-label">Senha Atual</label>
                        <div class="input-with-icon">
                            <i class="fas fa-key input-icon"></i>
                            <input type="password" id="current_password" name="current_password"
                                class="form-control @error('current_password') error @enderror" required
                                placeholder="Digite sua senha atual">
                        </div>
                        @error('current_password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Nova Senha</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') error @enderror" required
                                placeholder="Mínimo 8 caracteres">
                        </div>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirmar Nova Senha</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control" required placeholder="Digite a nova senha novamente">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success btn-large">
                            <i class="fas fa-shield-alt"></i>
                            Alterar Senha
                        </button>
                    </div>
                </form>
            </div>

            @if($user->isEmployee() && $user->employee)
                <div class="form-card employee-info-card">
                    <div class="form-card-header">
                        <div class="card-icon">
                            <i class="fas fa-id-badge"></i>
                        </div>
                        <div class="card-title">
                            <h2>Informações de Funcionário</h2>
                            <p>Dados vinculados ao seu perfil profissional</p>
                        </div>
                    </div>

                    <div class="employee-info-display">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="info-content">
                                <label>Departamento</label>
                                <span class="info-value">{{ $user->employee->department->name ?? 'Não informado' }}</span>
                                @if($user->employee->department && $user->employee->department->description)
                                    <small class="info-desc">{{ $user->employee->department->description }}</small>
                                @endif
                            </div>
                        </div>

                        @if($user->employee->address)
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="info-content">
                                    <label>Endereço</label>
                                    <span class="info-value">{{ $user->employee->address }}</span>
                                </div>
                            </div>
                        @endif

                        @if($user->employee->age)
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-birthday-cake"></i>
                                </div>
                                <div class="info-content">
                                    <label>Idade</label>
                                    <span class="info-value">{{ $user->employee->age }} anos</span>
                                </div>
                            </div>
                        @endif

                        <div class="employee-note">
                            <i class="fas fa-info-circle"></i>
                            <p>Para alterar essas informações, entre em contato com o administrador do sistema.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        .edit-profile-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Header */
        .edit-profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            padding: 2rem;
            background: linear-gradient(135deg, var(--accent-blue), var(--primary-red));
            border-radius: 2rem;
            color: white;
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.2);
        }

        .header-content {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .header-icon {
            font-size: 3.5rem;
            opacity: 0.9;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .page-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin: 0.5rem 0 0;
            font-weight: 500;
        }

        .btn-modern {
            padding: 1rem 2rem;
            font-weight: 700;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            text-decoration: none;
        }

        .btn-modern:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            color: white;
            text-decoration: none;
        }

        /* Alert de Sucesso */
        .alert-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 1.5rem;
            border-radius: var(--rounded-xl);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }

        /* Grid de Formulários */
        .edit-forms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
            gap: 2rem;
        }

        .form-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 2rem;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .form-card-header {
            background: white;
            border-bottom: 2px solid #e2e8f0;
            padding: 2rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .card-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border: 2px solid rgba(239, 68, 68, 0.2);
            border-radius: var(--rounded-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-red);
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .card-title h2 {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-primary);
            margin: 0 0 0.5rem;
        }

        .card-title p {
            color: var(--text-secondary);
            margin: 0;
            font-weight: 500;
        }

        .modern-form {
            padding: 2.5rem;
        }

        .btn-large {
            width: 100%;
            padding: 1.25rem 2rem;
            font-size: 1.1rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
            border: none;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(16, 185, 129, 0.3);
        }

        /* Card de Informações do Funcionário */
        .employee-info-card {
            grid-column: span 2;
        }

        .employee-info-display {
            padding: 2.5rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1.5rem;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: var(--rounded-xl);
            margin-bottom: 1.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .info-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-red);
        }

        .info-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border: 2px solid rgba(239, 68, 68, 0.2);
            border-radius: var(--rounded-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-red);
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .info-content {
            flex: 1;
        }

        .info-content label {
            display: block;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .info-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-primary);
            display: block;
        }

        .info-desc {
            display: block;
            font-size: 0.9rem;
            color: var(--text-secondary);
            font-style: italic;
            margin-top: 0.25rem;
        }

        .employee-note {
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            border: 2px solid #bfdbfe;
            border-radius: var(--rounded-lg);
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .employee-note i {
            color: var(--accent-blue);
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .employee-note p {
            color: var(--text-secondary);
            margin: 0;
            font-weight: 500;
        }

        /* Responsividade */
        @media (max-width: 1024px) {
            .employee-info-card {
                grid-column: span 1;
            }

            .edit-forms-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .edit-profile-container {
                padding: 1rem;
            }

            .edit-profile-header {
                flex-direction: column;
                text-align: center;
                gap: 2rem;
            }

            .header-content {
                flex-direction: column;
                gap: 1rem;
            }

            .page-title {
                font-size: 2rem;
            }

            .modern-form {
                padding: 2rem;
            }

            .form-card-header {
                padding: 1.5rem;
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .edit-forms-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .modern-form,
            .employee-info-display {
                padding: 1.5rem;
            }

            .info-item {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');

            function validatePasswords() {
                if (confirmPasswordInput.value && passwordInput.value !== confirmPasswordInput.value) {
                    confirmPasswordInput.classList.add('error');
                    confirmPasswordInput.nextElementSibling?.remove();
                    const errorSpan = document.createElement('span');
                    errorSpan.className = 'error-message';
                    errorSpan.textContent = 'As senhas não coincidem';
                    confirmPasswordInput.parentNode.parentNode.appendChild(errorSpan);
                } else {
                    confirmPasswordInput.classList.remove('error');
                    const errorSpan = confirmPasswordInput.parentNode.parentNode.querySelector('.error-message');
                    errorSpan?.remove();
                }
            }

            if (passwordInput && confirmPasswordInput) {
                passwordInput.addEventListener('input', validatePasswords);
                confirmPasswordInput.addEventListener('input', validatePasswords);
            }
        });
    </script>
@endsection