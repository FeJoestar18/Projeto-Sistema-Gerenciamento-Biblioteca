@extends('layouts.system')

@section('title', 'Meu Perfil')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>👤 Meu Perfil</h1>
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                ✏️ Editar Perfil
            </a>
        </div>

        <div class="profile-card">
            <div class="profile-info">
                <div class="profile-avatar">
                    <span class="avatar-initial">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                </div>

                <div class="profile-details">
                    <div class="detail-item">
                        <label>Nome:</label>
                        <span class="detail-value">{{ $user->name }}</span>
                    </div>

                    <div class="detail-item">
                        <label>E-mail:</label>
                        <span class="detail-value">{{ $user->email }}</span>
                    </div>

                    <div class="detail-item">
                        <label>Membro desde:</label>
                        <span class="detail-value">{{ $user->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            <div class="profile-stats">
                <div class="stat-item">
                    <span class="stat-number">{{ $user->role }}</span>
                    <span class="stat-label">Tipo de Conta</span>
                </div>

                @if($user->isEmployee() || $user->isAdmin())
                    <div class="stat-item">
                        <span class="stat-number">{{ \App\Models\Book::where('created_by', $user->id)->count() }}</span>
                        <span class="stat-label">Livros Cadastrados</span>
                    </div>
                @endif

                @if($user->isEmployee() || $user->isAdmin())
                    <div class="stat-item">
                        <span class="stat-number">{{ \App\Models\StockLog::where('user_id', $user->id)->count() }}</span>
                        <span class="stat-label">Operações de Estoque</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .profile-card {
            background: linear-gradient(135deg, var(--medium-gray) 0%, var(--light-gray) 100%);
            border: 1px solid rgba(196, 30, 58, 0.3);
            border-radius: 8px;
            padding: 2rem;
            margin-top: 2rem;
        }

        .profile-info {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid rgba(196, 30, 58, 0.2);
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--primary-red), #ff3333);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 2rem;
            box-shadow: 0 4px 8px rgba(196, 30, 58, 0.3);
        }

        .avatar-initial {
            color: white;
            font-size: 2.5rem;
            font-weight: bold;
        }

        .profile-details {
            flex: 1;
        }

        .detail-item {
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .detail-item label {
            font-weight: 600;
            color: var(--text-light);
            width: 140px;
            margin-right: 1rem;
        }

        .detail-value {
            color: var(--white);
            font-size: 1.1rem;
        }

        .profile-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1.5rem;
        }

        .stat-item {
            text-align: center;
            background-color: var(--dark-gray);
            padding: 1.5rem;
            border-radius: 8px;
            border: 1px solid rgba(196, 30, 58, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(196, 30, 58, 0.4);
        }

        .stat-number {
            display: block;
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary-red);
            margin-bottom: 0.5rem;
            text-transform: capitalize;
        }

        .stat-label {
            color: var(--text-light);
            font-size: 0.9rem;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .profile-info {
                flex-direction: column;
                text-align: center;
            }

            .profile-avatar {
                margin-right: 0;
                margin-bottom: 1.5rem;
            }

            .detail-item {
                flex-direction: column;
                text-align: center;
            }

            .detail-item label {
                width: auto;
                margin-right: 0;
                margin-bottom: 0.5rem;
            }

            .profile-stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection