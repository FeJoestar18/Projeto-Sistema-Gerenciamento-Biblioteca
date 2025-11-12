@extends('layouts.system')

@section('title', 'Minhas Mensagens')

@section('content')
    <div class="messages-container">
        <div class="messages-header">
            <div class="header-content">
                <div class="header-icon">
                    <i class="fas fa-inbox"></i>
                </div>
                <div class="header-text">
                    <h1 class="page-title">Minhas Mensagens</h1>
                    <p class="page-subtitle">Acompanhe o status de suas mensagens de contato</p>
                </div>
            </div>
            <a href="{{ route('contact.create') }}" class="btn btn-primary btn-modern">
                <i class="fas fa-plus"></i>
                Nova Mensagem
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Lista de Mensagens -->
        @if($messages->count() > 0)
            <div class="messages-grid">
                @foreach($messages as $message)
                    <div class="message-card">
                        <div class="message-header">
                            <div class="message-status">
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
                                <span class="message-date">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <h3 class="message-subject">{{ $message->subject }}</h3>
                        </div>

                        <div class="message-content">
                            <p class="message-preview">{{ Str::limit($message->message, 120) }}</p>

                            @if($message->response)
                                <div class="response-indicator">
                                    <i class="fas fa-reply"></i>
                                    <span>Respondido em {{ $message->responded_at->format('d/m/Y H:i') }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="message-actions">
                            <a href="{{ route('contact.show', $message) }}" class="btn btn-outline">
                                <i class="fas fa-eye"></i>
                                Ver Detalhes
                            </a>

                            @if($message->assignedTo)
                                <div class="assigned-to">
                                    <i class="fas fa-user"></i>
                                    Atribuído a: {{ $message->assignedTo->name }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginação -->
            @if($messages->hasPages())
                <div class="pagination-wrapper">
                    {{ $messages->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-inbox"></i>
                </div>
                <h3>Nenhuma mensagem encontrada</h3>
                <p>Você ainda não enviou nenhuma mensagem para nossa equipe de suporte.</p>
                <a href="{{ route('contact.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Enviar Primeira Mensagem
                </a>
            </div>
        @endif
    </div>

    <style>
        .messages-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Header */
        .messages-header {
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

        /* Grid de Mensagens */
        .messages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .message-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--rounded-xl);
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 2px solid #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .message-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border-color: var(--primary-red);
        }

        .message-header {
            margin-bottom: 1.5rem;
        }

        .message-status {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: var(--rounded-full);
            font-size: 0.85rem;
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

        .message-date {
            font-size: 0.9rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .message-subject {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--text-primary);
            margin: 0;
            line-height: 1.3;
        }

        .message-content {
            margin-bottom: 1.5rem;
        }

        .message-preview {
            color: var(--text-secondary);
            line-height: 1.6;
            margin: 0 0 1rem;
        }

        .response-indicator {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem;
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            border: 2px solid #a7f3d0;
            border-radius: var(--rounded-lg);
            font-size: 0.9rem;
            color: #065f46;
            font-weight: 600;
        }

        .response-indicator i {
            color: #10b981;
        }

        .message-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .btn-outline {
            padding: 0.75rem 1.5rem;
            border: 2px solid var(--primary-red);
            color: var(--primary-red);
            background: transparent;
            border-radius: var(--rounded-lg);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-outline:hover {
            background: var(--primary-red);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(239, 68, 68, 0.3);
            text-decoration: none;
        }

        .assigned-to {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .assigned-to i {
            color: var(--accent-blue);
        }

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
            margin: 0 0 2rem;
            line-height: 1.6;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        @media (max-width: 768px) {
            .messages-container {
                padding: 1rem;
            }

            .messages-header {
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

            .messages-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .message-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .assigned-to {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .message-card {
                padding: 1.5rem;
            }

            .message-status {
                flex-direction: column;
                gap: 0.5rem;
                align-items: flex-start;
            }
        }
    </style>
@endsection