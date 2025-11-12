@extends('layouts.system')

@section('title', 'Detalhes da Mensagem')

@section('content')
    <div class="message-detail-container">
        <!-- Header -->
        <div class="message-detail-header">
            <div class="header-content">
                <div class="header-icon">
                    <i class="fas fa-envelope-open"></i>
                </div>
                <div class="header-text">
                    <h1 class="page-title">Detalhes da Mensagem</h1>
                    <p class="page-subtitle">{{ $contactMessage->subject }}</p>
                </div>
            </div>
            <a href="{{ route('contact.my-messages') }}" class="btn btn-secondary btn-modern">
                <i class="fas fa-arrow-left"></i>
                Voltar
            </a>
        </div>

        <!-- Informações da Mensagem -->
        <div class="message-info-card">
            <div class="message-status-bar">
                <div class="status-info">
                    <span class="status-badge status-{{ $contactMessage->getStatusBadgeColor() }}">
                        @if($contactMessage->status === 'open')
                            <i class="fas fa-envelope"></i>
                        @elseif($contactMessage->status === 'in_progress')
                            <i class="fas fa-clock"></i>
                        @else
                            <i class="fas fa-check"></i>
                        @endif
                        {{ $contactMessage->getStatusDisplayName() }}
                    </span>
                </div>
                <div class="message-meta">
                    <div class="meta-item">
                        <i class="fas fa-calendar-alt"></i>
                        Enviado em {{ $contactMessage->created_at->format('d/m/Y H:i') }}
                    </div>
                    @if($contactMessage->assignedTo)
                        <div class="meta-item">
                            <i class="fas fa-user"></i>
                            Atribuído a {{ $contactMessage->assignedTo->name }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="message-content-section">
                <h3 class="section-title">
                    <i class="fas fa-comment"></i>
                    Sua Mensagem
                </h3>
                <div class="message-content">
                    <div class="message-text">
                        {{ $contactMessage->message }}
                    </div>
                </div>
            </div>

            @if($contactMessage->response)
                <div class="response-section">
                    <h3 class="section-title">
                        <i class="fas fa-reply"></i>
                        Resposta da Equipe
                    </h3>
                    <div class="response-content">
                        <div class="response-header">
                            <div class="responder-info">
                                @if($contactMessage->assignedTo)
                                    <div class="responder-avatar">
                                        {{ strtoupper(substr($contactMessage->assignedTo->name, 0, 1)) }}
                                    </div>
                                    <div class="responder-details">
                                        <span class="responder-name">{{ $contactMessage->assignedTo->name }}</span>
                                        <span class="response-date">{{ $contactMessage->responded_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="response-text">
                            {{ $contactMessage->response }}
                        </div>
                    </div>
                </div>
            @else
                <div class="no-response-section">
                    <div class="no-response-content">
                        <i class="fas fa-hourglass-half"></i>
                        <h4>Aguardando Resposta</h4>
                        <p>Nossa equipe está analisando sua mensagem e responderá em breve.</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Ações -->
        <div class="message-actions-section">
            @if(!$contactMessage->isClosed())
                <div class="action-card">
                    <h4>Precisa de mais informações?</h4>
                    <p>Se você tem mais detalhes para adicionar, envie uma nova mensagem.</p>
                    <a href="{{ route('contact.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Nova Mensagem
                    </a>
                </div>
            @endif

            <div class="action-card">
                <h4>Suas Mensagens</h4>
                <p>Veja todas as suas mensagens de contato.</p>
                <a href="{{ route('contact.my-messages') }}" class="btn btn-outline">
                    <i class="fas fa-list"></i>
                    Ver Todas
                </a>
            </div>
        </div>
    </div>

    <style>
        .message-detail-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Header */
        .message-detail-header {
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

        .header-content {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex: 1;
        }

        .header-icon {
            font-size: 3.5rem;
            opacity: 0.9;
        }

        .page-title {
            font-size: 2rem;
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

        /* Card da Mensagem */
        .message-info-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 2rem;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 2rem;
        }

        .message-status-bar {
            background: white;
            border-bottom: 2px solid #e2e8f0;
            padding: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: var(--rounded-full);
            font-size: 0.9rem;
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

        .message-meta {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .meta-item i {
            color: var(--primary-red);
        }

        /* Seções de Conteúdo */
        .message-content-section,
        .response-section {
            padding: 2.5rem;
            border-bottom: 2px solid #f1f5f9;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--text-primary);
            margin: 0 0 1.5rem;
        }

        .section-title i {
            color: var(--primary-red);
        }

        .message-text {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: var(--rounded-xl);
            padding: 2rem;
            font-size: 1rem;
            line-height: 1.7;
            color: var(--text-primary);
            white-space: pre-wrap;
        }

        /* Seção de Resposta */
        .response-content {
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            border: 2px solid #a7f3d0;
            border-radius: var(--rounded-xl);
            overflow: hidden;
        }

        .response-header {
            background: rgba(16, 185, 129, 0.1);
            padding: 1.5rem;
            border-bottom: 1px solid #a7f3d0;
        }

        .responder-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .responder-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
            font-weight: 800;
        }

        .responder-name {
            font-weight: 700;
            color: #065f46;
            display: block;
        }

        .response-date {
            font-size: 0.9rem;
            color: #047857;
        }

        .response-text {
            padding: 2rem;
            font-size: 1rem;
            line-height: 1.7;
            color: #065f46;
            white-space: pre-wrap;
        }

        /* Sem Resposta */
        .no-response-section {
            padding: 2.5rem;
            text-align: center;
        }

        .no-response-content {
            background: #fefce8;
            border: 2px solid #fde047;
            border-radius: var(--rounded-xl);
            padding: 3rem;
        }

        .no-response-content i {
            font-size: 3rem;
            color: #f59e0b;
            margin-bottom: 1.5rem;
        }

        .no-response-content h4 {
            font-size: 1.25rem;
            font-weight: 800;
            color: #92400e;
            margin: 0 0 1rem;
        }

        .no-response-content p {
            color: #a16207;
            margin: 0;
            font-weight: 500;
        }

        /* Seção de Ações */
        .message-actions-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .action-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--rounded-xl);
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 2px solid #e2e8f0;
            text-align: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .action-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            border-color: var(--primary-red);
        }

        .action-card h4 {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text-primary);
            margin: 0 0 1rem;
        }

        .action-card p {
            color: var(--text-secondary);
            margin: 0 0 1.5rem;
            line-height: 1.6;
        }

        .btn-outline {
            padding: 0.75rem 1.5rem;
            border: 2px solid var(--primary-red);
            color: var(--primary-red);
            background: transparent;
            border-radius: var(--rounded-lg);
            font-weight: 600;
            display: inline-flex;
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

        /* Responsividade */
        @media (max-width: 768px) {
            .message-detail-container {
                padding: 1rem;
            }

            .message-detail-header {
                flex-direction: column;
                text-align: center;
                gap: 2rem;
            }

            .header-content {
                flex-direction: column;
                gap: 1rem;
            }

            .page-title {
                font-size: 1.75rem;
            }

            .message-status-bar {
                flex-direction: column;
                gap: 1.5rem;
                align-items: stretch;
                text-align: center;
            }

            .message-meta {
                flex-direction: column;
                gap: 1rem;
                align-items: center;
            }

            .message-actions-section {
                grid-template-columns: 1fr;
            }

            .responder-info {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {

            .message-content-section,
            .response-section {
                padding: 1.5rem;
            }

            .message-text,
            .response-text {
                padding: 1.5rem;
            }
        }
    </style>
@endsection