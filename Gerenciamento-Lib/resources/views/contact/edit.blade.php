@extends('layouts.system')

@section('title', 'Responder Contato')

@section('content')
    <div class="edit-contact-container">
        <!-- Header -->
        <div class="edit-contact-header">
            <div class="header-content">
                <div class="header-icon">
                    <i class="fas fa-reply"></i>
                </div>
                <div class="header-text">
                    <h1 class="page-title">Responder Contato</h1>
                    <p class="page-subtitle">{{ $contactMessage->subject }}</p>
                </div>
            </div>
            <a href="{{ route('contact.manage') }}" class="btn btn-secondary btn-modern">
                <i class="fas fa-arrow-left"></i>
                Voltar à Lista
            </a>
        </div>

        <!-- Informações da Mensagem Original -->
        <div class="original-message-card">
            <div class="message-header">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr($contactMessage->user->name, 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <h3>{{ $contactMessage->user->name }}</h3>
                        <span>{{ $contactMessage->user->email }}</span>
                        <div class="message-meta">
                            <span class="meta-item">
                                <i class="fas fa-calendar"></i>
                                {{ $contactMessage->created_at->format('d/m/Y H:i') }}
                            </span>
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
                    </div>
                </div>
            </div>

            <div class="message-content">
                <h4>Mensagem Original:</h4>
                <div class="message-text">
                    {{ $contactMessage->message }}
                </div>
            </div>
        </div>

        <!-- Resposta Atual (se existir) -->
        @if($contactMessage->response)
            <div class="current-response-card">
                <div class="response-header">
                    <i class="fas fa-reply"></i>
                    <h3>Resposta Atual</h3>
                    @if($contactMessage->assignedTo)
                        <span>Respondido por {{ $contactMessage->assignedTo->name }} em
                            {{ $contactMessage->responded_at->format('d/m/Y H:i') }}</span>
                    @endif
                </div>
                <div class="response-content">
                    {{ $contactMessage->response }}
                </div>
            </div>
        @endif

        <!-- Formulário de Resposta -->
        <div class="response-form-card">
            <div class="form-header">
                <h3>
                    <i class="fas fa-edit"></i>
                    {{ $contactMessage->response ? 'Atualizar Resposta' : 'Nova Resposta' }}
                </h3>
            </div>

            <form action="{{ route('contact.update', $contactMessage) }}" method="POST" class="response-form">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="form-group">
                        <label for="status" class="form-label">Status da Mensagem</label>
                        <select id="status" name="status" class="form-control @error('status') error @enderror" required>
                            <option value="open" {{ $contactMessage->status === 'open' ? 'selected' : '' }}>
                                📧 Aberto
                            </option>
                            <option value="in_progress" {{ $contactMessage->status === 'in_progress' ? 'selected' : '' }}>
                                ⏰ Em Andamento
                            </option>
                            <option value="closed" {{ $contactMessage->status === 'closed' ? 'selected' : '' }}>
                                ✅ Fechado
                            </option>
                        </select>
                        @error('status')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="response" class="form-label">Sua Resposta</label>
                    <div class="textarea-container">
                        <textarea id="response" name="response" class="form-control @error('response') error @enderror"
                            placeholder="Digite sua resposta para o usuário...">{{ old('response', $contactMessage->response) }}</textarea>
                        <div class="character-counter">
                            <span id="char-count">0</span>/2000 caracteres
                        </div>
                    </div>
                    @error('response')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-large">
                        <i class="fas fa-paper-plane"></i>
                        {{ $contactMessage->response ? 'Atualizar Resposta' : 'Enviar Resposta' }}
                    </button>
                    <a href="{{ route('contact.manage') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i>
                        Cancelar
                    </a>
                </div>
            </form>
        </div>

        <!-- Dicas de Atendimento -->
        <div class="tips-section">
            <h3 class="tips-title">
                <i class="fas fa-lightbulb"></i>
                Dicas para um Bom Atendimento
            </h3>

            <div class="tips-grid">
                <div class="tip-card">
                    <div class="tip-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="tip-content">
                        <h4>Seja Empático</h4>
                        <p>Demonstre compreensão pela situação do usuário</p>
                    </div>
                </div>

                <div class="tip-card">
                    <div class="tip-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="tip-content">
                        <h4>Responda Rapidamente</h4>
                        <p>Usuários valorizam respostas ágeis e eficientes</p>
                    </div>
                </div>

                <div class="tip-card">
                    <div class="tip-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="tip-content">
                        <h4>Seja Claro e Objetivo</h4>
                        <p>Use linguagem simples e direta</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .edit-contact-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Header */
        .edit-contact-header {
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

        /* Mensagem Original */
        .original-message-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 2rem;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 2rem;
        }

        .message-header {
            background: white;
            border-bottom: 2px solid #e2e8f0;
            padding: 2rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-red), var(--accent-blue));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: 800;
            flex-shrink: 0;
        }

        .user-details h3 {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-primary);
            margin: 0 0 0.5rem;
        }

        .user-details span {
            color: var(--text-secondary);
            font-weight: 500;
            display: block;
            margin-bottom: 1rem;
        }

        .message-meta {
            display: flex;
            gap: 1.5rem;
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

        .message-content {
            padding: 2rem;
        }

        .message-content h4 {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--text-primary);
            margin: 0 0 1rem;
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

        /* Resposta Atual */
        .current-response-card {
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            border: 2px solid #a7f3d0;
            border-radius: 2rem;
            overflow: hidden;
            margin-bottom: 2rem;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.2);
        }

        .response-header {
            background: rgba(16, 185, 129, 0.1);
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #a7f3d0;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .response-header i {
            color: #10b981;
            font-size: 1.25rem;
        }

        .response-header h3 {
            font-size: 1.25rem;
            font-weight: 800;
            color: #065f46;
            margin: 0;
            flex: 1;
        }

        .response-header span {
            font-size: 0.9rem;
            color: #047857;
            font-weight: 500;
        }

        .response-content {
            padding: 2rem;
            font-size: 1rem;
            line-height: 1.7;
            color: #065f46;
            white-space: pre-wrap;
        }

        /* Formulário de Resposta */
        .response-form-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 2rem;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 2rem;
        }

        .form-header {
            background: white;
            border-bottom: 2px solid #e2e8f0;
            padding: 2rem;
        }

        .form-header h3 {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-primary);
            margin: 0;
        }

        .form-header i {
            color: var(--primary-red);
        }

        .response-form {
            padding: 2.5rem;
        }

        .form-row {
            margin-bottom: 2rem;
        }

        .textarea-container {
            position: relative;
        }

        .textarea-container textarea {
            min-height: 150px;
            resize: vertical;
            padding-bottom: 3rem;
        }

        .character-counter {
            position: absolute;
            bottom: 1rem;
            right: 1rem;
            font-size: 0.85rem;
            color: var(--text-secondary);
            background: rgba(255, 255, 255, 0.9);
            padding: 0.25rem 0.5rem;
            border-radius: var(--rounded-md);
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-large {
            padding: 1.25rem 2rem;
            font-size: 1.1rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            flex: 1;
            justify-content: center;
        }

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

        /* Seção de Dicas */
        .tips-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 2rem;
            padding: 3rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .tips-title {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-primary);
            margin: 0 0 2rem;
        }

        .tips-title i {
            color: var(--primary-red);
        }

        .tips-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .tip-card {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.5rem;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: var(--rounded-xl);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .tip-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-red);
        }

        .tip-icon {
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

        .tip-content h4 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0 0 0.5rem;
        }

        .tip-content p {
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin: 0;
            line-height: 1.5;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .edit-contact-container {
                padding: 1rem;
            }

            .edit-contact-header {
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

            .user-info {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .message-meta {
                flex-direction: column;
                gap: 1rem;
                align-items: center;
            }

            .response-form {
                padding: 2rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .tips-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {

            .message-content,
            .response-form {
                padding: 1.5rem;
            }

            .tip-card {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Contador de caracteres
            const responseTextarea = document.getElementById('response');
            const charCount = document.getElementById('char-count');

            if (responseTextarea && charCount) {
                function updateCharCount() {
                    const count = responseTextarea.value.length;
                    charCount.textContent = count;

                    if (count > 2000) {
                        charCount.style.color = '#ef4444';
                    } else if (count > 1800) {
                        charCount.style.color = '#f59e0b';
                    } else {
                        charCount.style.color = '#6b7280';
                    }
                }

                responseTextarea.addEventListener('input', updateCharCount);
                updateCharCount(); // Initial count
            }

            // Auto-salvar rascunho (localStorage)
            if (responseTextarea) {
                const messageId = {{ $contactMessage->id }};
                const draftKey = `contact_response_draft_${messageId}`;

                // Carregar rascunho
                const savedDraft = localStorage.getItem(draftKey);
                if (savedDraft && !responseTextarea.value) {
                    responseTextarea.value = savedDraft;
                    updateCharCount();
                }

                // Salvar rascunho
                responseTextarea.addEventListener('input', function () {
                    localStorage.setItem(draftKey, this.value);
                });

                // Limpar rascunho ao enviar
                document.querySelector('.response-form').addEventListener('submit', function () {
                    localStorage.removeItem(draftKey);
                });
            }
        });
    </script>
@endsection