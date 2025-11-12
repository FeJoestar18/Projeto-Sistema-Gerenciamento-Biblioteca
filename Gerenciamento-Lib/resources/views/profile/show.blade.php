@extends('layouts.system')

@section('title', 'Meu Perfil')

@section('content')
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-header-content">
                <div class="profile-icon">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="header-text">
                    <h1 class="page-title">Meu Perfil</h1>
                    <p class="page-subtitle">Gerencie suas informações pessoais</p>
                </div>
            </div>
            <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-modern">
                <i class="fas fa-edit"></i>
                Editar Perfil
            </a>
        </div>

        <div class="profile-main-card">
            <div class="profile-avatar-section">
                <div class="profile-avatar">
                    <span class="avatar-letter">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                </div>
                <div class="avatar-info">
                    <h2 class="user-name">{{ $user->name }}</h2>
                    <div class="user-role">
                        <span class="role-badge role-{{ $user->role }}">
                            @if($user->isAdmin())
                                <i class="fas fa-crown"></i> Administrador
                            @elseif($user->isEmployee())
                                <i class="fas fa-id-badge"></i> Funcionário
                            @else
                                <i class="fas fa-user"></i> Usuário
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <div class="profile-info-grid">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-content">
                        <label>Email</label>
                        <span class="info-value">{{ $user->email }}</span>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="info-content">
                        <label>Membro desde</label>
                        <span class="info-value">{{ $user->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>

                @if($user->isEmployee() && $user->employee && $user->employee->department)
                    <div class="info-card department-card">
                        <div class="info-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="info-content">
                            <label>Departamento</label>
                            <span class="info-value">{{ $user->employee->department->name }}</span>
                            @if($user->employee->department->description)
                                <small class="department-desc">{{ $user->employee->department->description }}</small>
                            @endif
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-content">
                            <label>Endereço</label>
                            <span class="info-value">{{ $user->employee->address ?? 'Não informado' }}</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="profile-stats-section">
            <h3 class="stats-title">
                <i class="fas fa-chart-line"></i>
                Estatísticas de Atividade
            </h3>

            <div class="stats-grid">
                @if($user->isEmployee() || $user->isAdmin())
                    <div class="stat-card books-stat">
                        <div class="stat-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="stat-content">
                            <span class="stat-number">{{ \App\Models\Book::where('created_by', $user->id)->count() }}</span>
                            <span class="stat-label">Livros Cadastrados</span>
                        </div>
                    </div>

                    <div class="stat-card stock-stat">
                        <div class="stat-icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <div class="stat-content">
                            <span class="stat-number">{{ \App\Models\StockLog::where('user_id', $user->id)->count() }}</span>
                            <span class="stat-label">Operações de Estoque</span>
                        </div>
                    </div>
                @endif

                <div class="stat-card activity-stat">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-number">{{ $user->updated_at->diffForHumans() }}</span>
                        <span class="stat-label">Última Atividade</span>
                    </div>
                </div>

                @if($user->isAdmin())
                    <div class="stat-card admin-stat">
                        <div class="stat-icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <div class="stat-content">
                            <span class="stat-number">{{ \App\Models\User::count() }}</span>
                            <span class="stat-label">Total de Usuários</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            padding: 2rem;
            background: linear-gradient(135deg, var(--primary-red), var(--accent-blue));
            border-radius: 2rem;
            color: white;
            box-shadow: 0 20px 40px rgba(239, 68, 68, 0.2);
        }

        .profile-header-content {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .profile-icon {
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
        }

        .btn-modern:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* Cartão Principal */
        .profile-main-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 2rem;
            padding: 3rem;
            margin-bottom: 2rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .profile-avatar-section {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-bottom: 3rem;
            padding-bottom: 2rem;
            border-bottom: 2px solid rgba(239, 68, 68, 0.1);
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, var(--primary-red), var(--accent-blue));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 20px 40px rgba(239, 68, 68, 0.3);
            position: relative;
        }

        .avatar-letter {
            font-size: 3rem;
            font-weight: 900;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .user-name {
            font-size: 2rem;
            font-weight: 800;
            margin: 0 0 1rem;
            color: var(--text-primary);
        }

        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: var(--rounded-full);
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .role-admin {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
        }

        .role-funcionario {
            background: linear-gradient(135deg, var(--accent-blue), #1e40af);
            color: white;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
        }

        .role-usuario {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        }

        /* Grid de Informações */
        .profile-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .info-card {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1.5rem;
            background: white;
            border-radius: var(--rounded-xl);
            border: 2px solid #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .info-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
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

        .department-card {
            grid-column: span 2;
        }

        .department-desc {
            display: block;
            font-size: 0.9rem;
            color: var(--text-secondary);
            font-style: italic;
            margin-top: 0.25rem;
        }

        /* Seção de Estatísticas */
        .profile-stats-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 2rem;
            padding: 3rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stats-title {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 2rem;
        }

        .stats-title i {
            color: var(--primary-red);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .stat-card {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 2rem;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: var(--rounded-xl);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-red), var(--accent-blue));
        }

        .books-stat::before {
            background: linear-gradient(135deg, #3b82f6, #1e40af);
        }

        .stock-stat::before {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .activity-stat::before {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .admin-stat::before {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-red);
        }

        .stat-icon {
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

        .stat-content {
            flex: 1;
        }

        .stat-number {
            display: block;
            font-size: 2rem;
            font-weight: 900;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Responsividade */
        @media (max-width: 1024px) {
            .department-card {
                grid-column: span 1;
            }
        }

        @media (max-width: 768px) {
            .profile-container {
                padding: 1rem;
            }

            .profile-header {
                flex-direction: column;
                text-align: center;
                gap: 2rem;
            }

            .profile-header-content {
                flex-direction: column;
                gap: 1rem;
            }

            .profile-avatar-section {
                flex-direction: column;
                text-align: center;
            }

            .profile-info-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {

            .profile-main-card,
            .profile-stats-section {
                padding: 2rem;
            }

            .stat-card {
                padding: 1.5rem;
            }
        }
    </style>
@endsection