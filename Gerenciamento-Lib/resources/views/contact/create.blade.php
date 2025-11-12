@extends('layouts.system')

@section('title', 'Fale Conosco')

@section('content')
    <div class="contact-container">
        <!-- Header -->
        <div class="contact-header">
            <div class="header-content">
                <div class="header-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <div class="header-text">
                    <h1 class="page-title">Fale Conosco</h1>
                    <p class="page-subtitle">Envie sua dúvida ou sugestão. Nossa equipe responderá o mais breve possível!
                    </p>
                </div>
            </div>
            <a href="{{ route('contact.my-messages') }}" class="btn btn-secondary btn-modern">
                <i class="fas fa-inbox"></i>
                Minhas Mensagens
            </a>
        </div>

        <!-- Formulário de Contato -->
        <div class="contact-form-card">
            <div class="form-card-header">
                <div class="card-icon">
                    <i class="fas fa-paper-plane"></i>
                </div>
                <div class="card-title">
                    <h2>Nova Mensagem</h2>
                    <p>Preencha o formulário abaixo com sua dúvida ou sugestão</p>
                </div>
            </div>

            <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                @csrf

                <div class="form-group">
                    <label for="subject" class="form-label">Assunto</label>
                    <div class="input-with-icon">
                        <i class="fas fa-tag input-icon"></i>
                        <input type="text" id="subject" name="subject"
                            class="form-control @error('subject') error @enderror" value="{{ old('subject') }}" required
                            placeholder="Descreva brevemente o assunto">
                    </div>
                    @error('subject')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="message" class="form-label">Mensagem</label>
                    <div class="textarea-container">
                        <textarea id="message" name="message" class="form-control @error('message') error @enderror"
                            required
                            placeholder="Descreva detalhadamente sua dúvida ou sugestão...">{{ old('message') }}</textarea>
                        <div class="character-counter">
                            <span id="char-count">0</span>/2000 caracteres
                        </div>
                    </div>
                    @error('message')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-large">
                        <i class="fas fa-paper-plane"></i>
                        Enviar Mensagem
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i>
                        Cancelar
                    </a>
                </div>
            </form>
        </div>

        <!-- Informações de Contato -->
        <div class="contact-info-section">
            <h3 class="info-title">
                <i class="fas fa-info-circle"></i>
                Informações Importantes
            </h3>

            <div class="info-cards">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="info-content">
                        <h4>Tempo de Resposta</h4>
                        <p>Respondemos em até 24 horas úteis</p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="info-content">
                        <h4>Equipe Especializada</h4>
                        <p>Nossa equipe de atendimento está pronta para ajudá-lo</p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="info-content">
                        <h4>Privacidade Garantida</h4>
                        <p>Suas informações são tratadas com total confidencialidade</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .contact-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Header */
        .contact-header {
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

        /* Formulário */
        .contact-form-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 2rem;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 2rem;
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

        .contact-form {
            padding: 2.5rem;
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

        /* Seção de Informações */
        .contact-info-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 2rem;
            padding: 3rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .info-title {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 2rem;
        }

        .info-title i {
            color: var(--primary-red);
        }

        .info-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .info-card {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1.5rem;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: var(--rounded-xl);
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

        .info-content h4 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0 0 0.5rem;
        }

        .info-content p {
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin: 0;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .contact-container {
                padding: 1rem;
            }

            .contact-header {
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

            .contact-form {
                padding: 2rem;
            }

            .form-card-header {
                padding: 1.5rem;
                flex-direction: column;
                text-align: center;
            }

            .form-actions {
                flex-direction: column;
            }

            .info-cards {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .info-card {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const messageTextarea = document.getElementById('message');
            const charCount = document.getElementById('char-count');

            if (messageTextarea && charCount) {
                function updateCharCount() {
                    const count = messageTextarea.value.length;
                    charCount.textContent = count;

                    if (count > 2000) {
                        charCount.style.color = '#ef4444';
                    } else if (count > 1800) {
                        charCount.style.color = '#f59e0b';
                    } else {
                        charCount.style.color = '#6b7280';
                    }
                }

                messageTextarea.addEventListener('input', updateCharCount);
                updateCharCount();
            }
        });
    </script>
@endsection