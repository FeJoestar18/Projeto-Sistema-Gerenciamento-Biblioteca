@extends('layouts.system')

@section('title', 'Gerenciar Contatos')

@section('content')
    <div class="manage-contact-container">
        <!-- Header -->
        <div class="manage-header">
            <div class="header-content">
                <div class="header-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <div class="header-text">
                    <h1 class="page-title">Gerenciar Contatos</h1>
                    <p class="page-subtitle">Painel de atendimento - Gerencie as mensagens dos usuários</p>
                </div>
            </div>
            <div class="header-stats">
                <div class="stat-item">
                    <span class="stat-number">{{ $messages->where('status', 'open')->count() }}</span>
                    <span class="stat-label">Abertas</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $messages->where('status', 'in_progress')->count() }}</span>
                    <span class="stat-label">Em Andamento</span>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Filtros -->
        <div class="filters-section">
            <div class="filter-tabs">
                <a href="?status=all" class="filter-tab {{ request('status', 'all') === 'all' ? 'active' : '' }}">
                    <i class="fas fa-list"></i>
                    Todas
                </a>
                <a href="?status=open" class="filter-tab {{ request('status') === 'open' ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i>
                    Abertas
                </a>
                <a href="?status=in_progress" class="filter-tab {{ request('status') === 'in_progress' ? 'active' : '' }}">
                    <i class="fas fa-clock"></i>
                    Em Andamento
                </a>
                <a href="?status=closed" class="filter-tab {{ request('status') === 'closed' ? 'active' : '' }}">
                    <i class="fas fa-check"></i>
                    Fechadas
                </a>
            </div>
        </div>

        <!-- Lista de Mensagens -->
        @if($messages->count() > 0)
            <div class="messages-table-container">
                <div class="table-responsive">
                    <table class="messages-table">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Usuário</th>
                                <th>Assunto</th>
                                <th>Data</th>
                                <th>Atribuído</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($messages as $message)
                                <tr class="message-row" data-status="{{ $message->status }}">
                                    <td>
                                        <span class="status-badge status-{{ $message->getStatusBadgeColor() }}">
                                            @if($message->status === 'open')
                                                <i class="fas fa-envelope"></i>
                                            @elseif($message->status === 'in_progress')
                                                <i class="fas fa-clock"></i>
                                            @else
                                                <i class="fas fa-check"></i>
                                            @endif
                                            {{ $message->getStatusDisplayName() }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="user-info">
                                            <div class="user-avatar">
                                                {{ strtoupper(substr($message->user->name, 0, 1)) }}
                                            </div>
                                            <div class="user-details">
                                                <span class="user-name">{{ $message->user->name }}</span>
                                                <span class="user-email">{{ $message->user->email }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="subject-preview">
                                            <h4>{{ Str::limit($message->subject, 40) }}</h4>
                                            <p>{{ Str::limit($message->message, 60) }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="date-info">
                                            <span class="date">{{ $message->created_at->format('d/m/Y') }}</span>
                                            <span class="time">{{ $message->created_at->format('H:i') }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($message->assignedTo)
                                            <div class="assigned-info">
                                                <div class="assigned-avatar">
                                                    {{ strtoupper(substr($message->assignedTo->name, 0, 1)) }}
                                                </div>
                                                <span>{{ $message->assignedTo->name }}</span>
                                            </div>
                                        @else
                                            <span class="not-assigned">Não atribuído</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('contact.edit', $message) }}" class="btn btn-sm btn-primary"
                                                title="Responder">
                                                <i class="fas fa-reply"></i>
                                            </a>
                                            @if(!$message->assignedTo)
                                                <form action="{{ route('contact.assign', $message) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success" title="Atribuir a mim">
                                                        <i class="fas fa-user-plus"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('contact.show', $message) }}" class="btn btn-sm btn-outline"
                                                title="Ver detalhes">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Paginação -->
            @if($messages->hasPages())
                <div class="pagination-wrapper">
                    {{ $messages->appends(request()->query())->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3>Nenhuma mensagem encontrada</h3>
                <p>Não há mensagens de contato no momento ou para o filtro selecionado.</p>
            </div>
        @endif
    </div>

    <style>
        .manage-contact-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Header */
        .manage-header {
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

        .header-stats {
            display: flex;
            gap: 2rem;
        }

        .stat-item {
            text-align: center;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.2);
            border-radius: var(--rounded-lg);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .stat-number {
            display: block;
            font-size: 2rem;
            font-weight: 900;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            opacity: 0.9;
        }

        /* Alert */
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

        /* Filtros */
        .filters-section {
            margin-bottom: 2rem;
        }

        .filter-tabs {
            display: flex;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.95);
            padding: 1rem;
            border-radius: var(--rounded-xl);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .filter-tab {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: var(--rounded-lg);
            text-decoration: none;
            color: var(--text-secondary);
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .filter-tab:hover,
        .filter-tab.active {
            background: var(--primary-red);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(239, 68, 68, 0.3);
            text-decoration: none;
        }

        /* Tabela */
        .messages-table-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 2rem;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 2rem;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .messages-table {
            width: 100%;
            border-collapse: collapse;
        }

        .messages-table th {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            padding: 1.5rem;
            text-align: left;
            font-weight: 800;
            color: var(--text-primary);
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            border-bottom: 2px solid #e2e8f0;
        }

        .messages-table td {
            padding: 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .message-row {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .message-row:hover {
            background: #f8fafc;
        }

        /* Componentes da Tabela */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: var(--rounded-full);
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .status-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .status-info {
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            color: white;
        }

        .status-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-red), var(--accent-blue));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            font-weight: 800;
            flex-shrink: 0;
        }

        .user-name {
            font-weight: 700;
            color: var(--text-primary);
            display: block;
        }

        .user-email {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .subject-preview h4 {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0 0 0.25rem;
        }

        .subject-preview p {
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin: 0;
            line-height: 1.4;
        }

        .date-info {
            text-align: center;
        }

        .date {
            font-weight: 600;
            color: var(--text-primary);
            display: block;
        }

        .time {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .assigned-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: var(--text-primary);
            font-weight: 500;
        }

        .assigned-avatar {
            width: 30px;
            height: 30px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.8rem;
            font-weight: 800;
            flex-shrink: 0;
        }

        .not-assigned {
            font-size: 0.9rem;
            color: var(--text-secondary);
            font-style: italic;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-sm {
            padding: 0.5rem;
            font-size: 0.85rem;
            border-radius: var(--rounded-md);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
        }

        .btn-outline {
            border: 2px solid var(--text-secondary);
            color: var(--text-secondary);
            background: transparent;
        }

        .btn-outline:hover {
            background: var(--text-secondary);
            color: white;
        }

        /* Estado Vazio */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 2rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .empty-icon {
            font-size: 4rem;
            color: var(--text-secondary);
            margin-bottom: 2rem;
            opacity: 0.6;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-primary);
            margin: 0 0 1rem;
        }

        .empty-state p {
            font-size: 1.1rem;
            color: var(--text-secondary);
            margin: 0;
            line-height: 1.6;
        }

        /* Paginação */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        /* Responsividade */
        @media (max-width: 1024px) {
            .manage-header {
                flex-direction: column;
                gap: 2rem;
                text-align: center;
            }

            .header-stats {
                justify-content: center;
            }

            .filter-tabs {
                flex-wrap: wrap;
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .manage-contact-container {
                padding: 1rem;
            }

            .page-title {
                font-size: 2rem;
            }

            .messages-table th,
            .messages-table td {
                padding: 1rem;
            }

            .user-info {
                flex-direction: column;
                gap: 0.5rem;
                text-align: center;
            }

            .action-buttons {
                flex-direction: column;
            }
        }

        @media (max-width: 640px) {
            .table-responsive {
                font-size: 0.85rem;
            }

            .messages-table th:nth-child(n+4),
            .messages-table td:nth-child(n+4) {
                display: none;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Auto-refresh a cada 30 segundos para mensagens novas
            if (window.location.search.includes('status=open') || !window.location.search.includes('status=')) {
                setTimeout(() => {
                    window.location.reload();
                }, 30000);
            }
        });
    </script>
@endsection