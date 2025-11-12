@extends('layouts.system')

@section('title', 'Quero Ajuda - FAQ')

@section('content')
    <div class="help-container">
        <!-- Header -->
        <div class="help-header">
            <div class="header-content">
                <div class="header-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <div class="header-text">
                    <h1 class="page-title">Quero Ajuda</h1>
                    <p class="page-subtitle">Perguntas Frequentes sobre o Sistema de Biblioteca</p>
                </div>
            </div>
        </div>

        <!-- Search Box -->
        <div class="search-section">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="faqSearch" placeholder="Digite sua dúvida aqui para encontrar respostas..."
                    autocomplete="off">
            </div>
            <p class="search-help">💡 Dica: Digite palavras-chave como "livro", "empréstimo", "conta" para encontrar
                rapidamente</p>
        </div>

        <!-- Statistics -->
        <div class="stats-section">
            <div class="stat-card">
                <div class="stat-icon">📚</div>
                <div class="stat-info">
                    <span class="stat-number">20</span>
                    <span class="stat-label">Perguntas</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">⏰</div>
                <div class="stat-info">
                    <span class="stat-number">
                        < 2min</span>
                            <span class="stat-label">Resposta Rápida</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-info">
                    <span class="stat-number">100%</span>
                    <span class="stat-label">Soluções</span>
                </div>
            </div>
        </div>

        <!-- FAQ Categories -->
        <div class="categories-section">
            <h2 class="categories-title">
                <i class="fas fa-layer-group"></i>
                Categorias de Ajuda
            </h2>
            <div class="categories-grid">
                <button class="category-btn active" data-category="all">
                    <i class="fas fa-th-large"></i>
                    Todas (20)
                </button>
                <button class="category-btn" data-category="account">
                    <i class="fas fa-user"></i>
                    Conta (5)
                </button>
                <button class="category-btn" data-category="books">
                    <i class="fas fa-book"></i>
                    Livros (8)
                </button>
                <button class="category-btn" data-category="system">
                    <i class="fas fa-cog"></i>
                    Sistema (4)
                </button>
                <button class="category-btn" data-category="support">
                    <i class="fas fa-headset"></i>
                    Suporte (3)
                </button>
            </div>
        </div>

        <!-- FAQ Items -->
        <div class="faq-section">
            <div class="faq-grid">

                <!-- Conta/Perfil -->
                <div class="faq-item" data-category="account" data-keywords="conta criar registrar cadastro perfil">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="question-content">
                            <span class="question-icon">👤</span>
                            <span class="question-text">Como criar uma conta no sistema?</span>
                        </div>
                        <div class="toggle-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Para criar sua conta:</strong></p>
                            <ol>
                                <li>Clique em "Criar Conta" na página inicial</li>
                                <li>Preencha seus dados pessoais (nome, email, senha)</li>
                                <li>Confirme sua senha</li>
                                <li>Clique em "Cadastrar"</li>
                            </ol>
                            <div class="tip-box">
                                <i class="fas fa-lightbulb"></i>
                                <strong>Dica:</strong> Use uma senha forte com pelo menos 8 caracteres!
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="account" data-keywords="login entrar senha esqueci recuperar">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="question-content">
                            <span class="question-icon">🔐</span>
                            <span class="question-text">Esqueci minha senha, como recuperar?</span>
                        </div>
                        <div class="toggle-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Para recuperar sua senha:</strong></p>
                            <ol>
                                <li>Na tela de login, clique em "Esqueci minha senha"</li>
                                <li>Digite seu email cadastrado</li>
                                <li>Verifique sua caixa de entrada (e spam)</li>
                                <li>Clique no link recebido e defina nova senha</li>
                            </ol>
                            <div class="warning-box">
                                <i class="fas fa-exclamation-triangle"></i>
                                <strong>Atenção:</strong> O link de recuperação expira em 60 minutos!
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="account" data-keywords="perfil editar alterar dados nome email">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="question-content">
                            <span class="question-icon">✏️</span>
                            <span class="question-text">Como editar meu perfil?</span>
                        </div>
                        <div class="toggle-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Para editar seu perfil:</strong></p>
                            <ol>
                                <li>Clique no seu avatar no canto superior direito</li>
                                <li>Selecione "Meu Perfil"</li>
                                <li>Clique em "Editar Perfil"</li>
                                <li>Altere as informações desejadas</li>
                                <li>Clique em "Salvar Alterações"</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="account" data-keywords="senha alterar trocar mudar segurança">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="question-content">
                            <span class="question-icon">🔒</span>
                            <span class="question-text">Como alterar minha senha?</span>
                        </div>
                        <div class="toggle-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Para alterar sua senha:</strong></p>
                            <ol>
                                <li>Vá em "Meu Perfil"</li>
                                <li>Clique em "Editar Perfil"</li>
                                <li>Na seção "Alterar Senha", digite a senha atual</li>
                                <li>Digite e confirme a nova senha</li>
                                <li>Clique em "Alterar Senha"</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="account" data-keywords="sair logout desconectar conta">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="question-content">
                            <span class="question-icon">🚪</span>
                            <span class="question-text">Como sair da minha conta?</span>
                        </div>
                        <div class="toggle-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Para sair do sistema:</strong></p>
                            <ol>
                                <li>Clique no seu avatar no canto superior direito</li>
                                <li>No menu dropdown, clique em "Sair"</li>
                                <li>Você será redirecionado para a página inicial</li>
                            </ol>
                            <div class="tip-box">
                                <i class="fas fa-lightbulb"></i>
                                <strong>Dica:</strong> Sempre faça logout em computadores públicos!
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Livros -->
                <div class="faq-item" data-category="books" data-keywords="livro buscar pesquisar encontrar catalogo">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="question-content">
                            <span class="question-icon">🔍</span>
                            <span class="question-text">Como buscar livros no catálogo?</span>
                        </div>
                        <div class="toggle-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Para buscar livros:</strong></p>
                            <ol>
                                <li>Vá na página "Catálogo"</li>
                                <li>Use a barra de pesquisa no topo</li>
                                <li>Digite título, autor ou palavra-chave</li>
                                <li>Pressione Enter ou clique na lupa</li>
                            </ol>
                            <p><strong>Você pode buscar por:</strong> Título, Autor, ISBN, Categoria</p>
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="books" data-keywords="reservar livro reserva solicitar">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="question-content">
                            <span class="question-icon">📝</span>
                            <span class="question-text">Como reservar um livro?</span>
                        </div>
                        <div class="toggle-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Para reservar um livro:</strong></p>
                            <ol>
                                <li>Encontre o livro desejado no catálogo</li>
                                <li>Clique no livro para ver os detalhes</li>
                                <li>Clique em "Reservar Livro"</li>
                                <li>Confirme sua reserva</li>
                            </ol>
                            <div class="info-box">
                                <i class="fas fa-info-circle"></i>
                                <strong>Importante:</strong> Você tem 48h para retirar o livro reservado!
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="books" data-keywords="disponivel estoque quantidade exemplares">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="question-content">
                            <span class="question-icon">📊</span>
                            <span class="question-text">Como saber se um livro está disponível?</span>
                        </div>
                        <div class="toggle-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Indicadores de disponibilidade:</strong></p>
                            <ul>
                                <li><span class="status-available">🟢 Disponível</span> - Há exemplares para empréstimo</li>
                                <li><span class="status-reserved">🟡 Reservado</span> - Livro está reservado</li>
                                <li><span class="status-unavailable">🔴 Indisponível</span> - Todos exemplares emprestados
                                </li>
                            </ul>
                            <p>A quantidade exata aparece na página de detalhes do livro.</p>
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="books" data-keywords="renovar emprestimo prazo devolver">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="question-content">
                            <span class="question-icon">🔄</span>
                            <span class="question-text">Como renovar o empréstimo de um livro?</span>
                        </div>
                        <div class="toggle-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Para renovar um empréstimo:</strong></p>
                            <ol>
                                <li>Acesse "Meus Empréstimos" no seu perfil</li>
                                <li>Encontre o livro que deseja renovar</li>
                                <li>Clique em "Renovar" (se disponível)</li>
                                <li>Confirme a renovação</li>
                            </ol>
                            <div class="warning-box">
                                <i class="fas fa-exclamation-triangle"></i>
                                <strong>Atenção:</strong> Só é possível renovar se não houver reservas para o livro!
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="books" data-keywords="prazo vencimento multa atraso devolver">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="question-content">
                            <span class="question-icon">⏰</span>
                            <span class="question-text">Qual o prazo para devolver livros?</span>
                        </div>
                        <div class="toggle-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Prazos de empréstimo:</strong></p>
                            <ul>
                                <li>📚 Livros didáticos: <strong>15 dias</strong></li>
                                <li>📖 Literatura geral: <strong>7 dias</strong></li>
                                <li>📰 Revistas e periódicos: <strong>3 dias</strong></li>
                            </ul>
                            <div class="warning-box">
                                <i class="fas fa-exclamation-triangle"></i>
                                <strong>Multa por atraso:</strong> R$ 1,00 por dia de atraso!
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="books" data-keywords="historico emprestimos anteriores livros lidos">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="question-content">
                            <span class="question-icon">📋</span>
                            <span class="question-text">Como ver meu histórico de empréstimos?</span>
                        </div>
                        <div class="toggle-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Para ver seu histórico:</strong></p>
                            <ol>
                                <li>Vá em "Meu Perfil"</li>
                                <li>Clique na aba "Histórico de Empréstimos"</li>
                                <li>Veja todos os livros já emprestados</li>
                                <li>Use os filtros para buscar livros específicos</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="books" data-keywords="favoritos lista desejos salvar livros">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="question-content">
                            <span class="question-icon">❤️</span>
                            <span class="question-text">Posso criar uma lista de livros favoritos?</span>
                        </div>
                        <div class="toggle-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Para salvar livros favoritos:</strong></p>
                            <ol>
                                <li>Na página do livro, clique no ❤️ (coração)</li>
                                <li>O livro será adicionado aos seus favoritos</li>
                                <li>Acesse "Meus Favoritos" no seu perfil</li>
                                <li>Gerencie sua lista como desejar</li>
                            </ol>
                            <div class="tip-box">
                                <i class="fas fa-lightbulb"></i>
                                <strong>Dica:</strong> Use favoritos para lembrar de livros que quer ler!
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="books" data-keywords="recomendar sugerir indicar livro novo">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="question-content">
                            <span class="question-icon">💡</span>
                            <span class="question-text">Como sugerir novos livros para o acervo?</span>
                        </div>
                        <div class="toggle-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Para sugerir novos livros:</strong></p>
                            <ol>
                                <li>Use o "Fale Conosco" no menu</li>
                                <li>Escolha o assunto "Sugestão de Livro"</li>
                                <li>Descreva o livro (título, autor, editora)</li>
                                <li>Explique por que seria útil no acervo</li>
                            </ol>
                            <p>Nossa equipe avaliará sua sugestão e responderá em até 5 dias úteis!</p>
                        </div>
                    </div>
                </div>

                <!-- Sistema -->
                <div class="faq-item" data-category="system" data-keywords="navegador browser compativel requisitos">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="question-content">
                            <span class="question-icon">🌐</span>
                            <span class="question-text">Quais navegadores são compatíveis?</span>
                        </div>
                        <div class="toggle-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Navegadores compatíveis:</strong></p>
                            <ul>
                                <li>🔵 Google Chrome (versão 80+)</li>
                                <li>🦊 Firefox (versão 75+)</li>
                                <li>🔷 Microsoft Edge (versão 80+)</li>
                                <li>🍎 Safari (versão 13+)</li>
                            </ul>
                            <div class="tip-box">
                                <i class="fas fa-lightbulb"></i>
                                <strong>Recomendação:</strong> Mantenha seu navegador sempre atualizado para melhor
                                experiência!
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="system" data-keywords="mobile celular tablet app aplicativo">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="question-content">
                            <span class="question-icon">📱</span>
                            <span class="question-text">O sistema funciona no celular?</span>
                        </div>
                        <div class="toggle-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Sim! O sistema é totalmente responsivo:</strong></p>
                            <ul>
                                <li>📱 Funciona perfeitamente em celulares</li>
                                <li>📱 Compatible com tablets</li>
                                <li>🖥️ Design adaptativo para todas as telas</li>
                                <li>⚡ Mesma velocidade e funcionalidades</li>
                            </ul>
                            <p>Acesse pelo navegador do seu dispositivo móvel!</p>
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="system" data-keywords="lento carregamento velocidade problema">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="question-content">
                            <span class="question-icon">🐌</span>
                            <span class="question-text">O sistema está lento, o que fazer?</span>
                        </div>
                        <div class="toggle-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Soluções para melhorar a velocidade:</strong></p>
                            <ol>
                                <li>Verifique sua conexão com a internet</li>
                                <li>Limpe o cache do navegador</li>
                                <li>Feche abas desnecessárias</li>
                                <li>Reinicie o navegador</li>
                                <li>Teste em outro dispositivo</li>
                            </ol>
                            <div class="info-box">
                                <i class="fas fa-info-circle"></i>
                                Se o problema persistir, entre em contato conosco!
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="system" data-keywords="notificacao email aviso lembrete">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="question-content">
                            <span class="question-icon">🔔</span>
                            <span class="question-text">Como receber notificações por email?</span>
                        </div>
                        <div class="toggle-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Você recebe emails automaticamente para:</strong></p>
                            <ul>
                                <li>📧 Confirmação de reservas</li>
                                <li>⏰ Lembrete de devolução (2 dias antes)</li>
                                <li>🚨 Aviso de atraso</li>
                                <li>✅ Confirmação de devolução</li>
                            </ul>
                            <p>Verifique sempre sua caixa de entrada e spam!</p>
                        </div>
                    </div>
                </div>

                <!-- Suporte -->
                <div class="faq-item" data-category="support" data-keywords="contato falar atendimento ajuda suporte">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="question-content">
                            <span class="question-icon">💬</span>
                            <span class="question-text">Como entrar em contato com o suporte?</span>
                        </div>
                        <div class="toggle-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Formas de contato:</strong></p>
                            <ul>
                                <li>💬 "Fale Conosco" no sistema (recomendado)</li>
                                <li>📧 Email: suporte@biblioteca.com</li>
                                <li>📞 Telefone: (11) 1234-5678</li>
                                <li>🕒 Horário: Segunda a Sexta, 8h às 18h</li>
                            </ul>
                            <div class="tip-box">
                                <i class="fas fa-lightbulb"></i>
                                <strong>Dica:</strong> Use o "Fale Conosco" para ter histórico das suas solicitações!
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="support" data-keywords="problema erro bug relatar">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="question-content">
                            <span class="question-icon">🐛</span>
                            <span class="question-text">Como relatar um problema no sistema?</span>
                        </div>
                        <div class="toggle-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Para relatar problemas:</strong></p>
                            <ol>
                                <li>Use "Fale Conosco" no menu</li>
                                <li>Escolha "Problema Técnico" como assunto</li>
                                <li>Descreva o problema detalhadamente</li>
                                <li>Inclua: que você estava fazendo, mensagem de erro, navegador usado</li>
                            </ol>
                            <p>Nossa equipe técnica resolverá rapidamente!</p>
                        </div>
                    </div>
                </div>

                <div class="faq-item" data-category="support" data-keywords="horario funcionamento atendimento disponivel">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        <div class="question-content">
                            <span class="question-icon">🕐</span>
                            <span class="question-text">Qual o horário de funcionamento da biblioteca?</span>
                        </div>
                        <div class="toggle-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="answer-content">
                            <p><strong>Horários de funcionamento:</strong></p>
                            <ul>
                                <li>🌅 Segunda a Sexta: 7h às 22h</li>
                                <li>🌤️ Sábados: 8h às 17h</li>
                                <li>☀️ Domingos: 9h às 15h</li>
                                <li>🎄 Feriados: Consulte nosso calendário</li>
                            </ul>
                            <div class="info-box">
                                <i class="fas fa-info-circle"></i>
                                <strong>O sistema online funciona 24h!</strong> Você pode pesquisar e reservar livros a
                                qualquer hora.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact CTA -->
        <div class="contact-cta">
            <div class="cta-content">
                <h3>Não encontrou sua resposta?</h3>
                <p>Nossa equipe está pronta para ajudar você!</p>
                @auth
                    <a href="{{ route('contact.create') }}" class="cta-button">
                        <i class="fas fa-comments"></i>
                        Falar com Suporte
                    </a>
                @else
                    <a href="{{ route('login') }}" class="cta-button">
                        <i class="fas fa-sign-in-alt"></i>
                        Fazer Login para Contato
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <style>
        /* Variables */
        :root {
            --help-primary: #ef4444;
            --help-secondary: #dc2626;
            --help-accent: #f87171;
            --help-blue: #3b82f6;
            --help-success: #10b981;
            --help-warning: #f59e0b;
            --help-danger: #ef4444;
            --help-info: #06b6d4;
            --help-light: #f8fafc;
            --help-border: #e2e8f0;
            --help-text: #1e293b;
            --help-text-light: #64748b;
            --help-shadow: 0 10px 25px rgba(239, 68, 68, 0.15);
            --help-shadow-hover: 0 20px 40px rgba(239, 68, 68, 0.25);
            --help-radius: 1.5rem;
            --help-gradient: linear-gradient(135deg, var(--help-primary), var(--help-accent));
            --help-glass: rgba(255, 255, 255, 0.95);
            --help-glass-border: rgba(255, 255, 255, 0.2);
        }

        /* Container */
        .help-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            background: linear-gradient(135deg, #fef2f2, #fee2e2);
            min-height: 100vh;
        }

        /* Header */
        .help-header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 4rem 2rem;
            background: var(--help-gradient);
            border-radius: 2rem;
            color: white;
            box-shadow: var(--help-shadow);
            position: relative;
            overflow: hidden;
        }

        .help-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="white" fill-opacity="0.05"><polygon points="60,60 0,60 30,0"/></g></g></svg>');
            pointer-events: none;
        }

        .header-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
            position: relative;
            z-index: 1;
        }

        .header-icon {
            font-size: 5rem;
            opacity: 0.95;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
        }

        .page-title {
            font-size: 3.5rem;
            font-weight: 900;
            margin: 0;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            letter-spacing: -0.02em;
        }

        .page-subtitle {
            font-size: 1.3rem;
            opacity: 0.95;
            margin: 0;
            font-weight: 500;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Search Section */
        .search-section {
            margin-bottom: 3rem;
        }

        .search-box {
            position: relative;
            max-width: 600px;
            margin: 0 auto 1rem;
        }

        .search-box i {
            position: absolute;
            left: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--help-primary);
            font-size: 1.25rem;
        }

        .search-box input {
            width: 100%;
            padding: 1.5rem 1.5rem 1.5rem 4rem;
            font-size: 1.1rem;
            border: 2px solid var(--help-border);
            border-radius: var(--help-radius);
            background: var(--help-glass);
            backdrop-filter: blur(10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.1);
            font-weight: 500;
        }

        .search-box input::placeholder {
            color: var(--help-text-light);
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--help-primary);
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1), 0 12px 35px rgba(239, 68, 68, 0.15);
            transform: translateY(-2px);
        }

        .search-help {
            text-align: center;
            color: var(--help-text-light);
            font-size: 0.95rem;
            margin: 0;
            font-weight: 500;
        }

        /* Stats Section */
        .stats-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 2.5rem 2rem;
            background: var(--help-glass);
            backdrop-filter: blur(20px);
            border: 1px solid var(--help-glass-border);
            border-radius: var(--help-radius);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--help-gradient);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--help-shadow-hover);
            border-color: rgba(239, 68, 68, 0.3);
        }

        .stat-icon {
            font-size: 3rem;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .stat-number {
            display: block;
            font-size: 1.75rem;
            font-weight: 900;
            color: var(--help-primary);
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .stat-label {
            display: block;
            font-size: 1rem;
            color: var(--help-text-light);
            font-weight: 600;
        }

        /* Categories Section */
        .categories-section {
            margin-bottom: 3rem;
        }

        .categories-title {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--help-text);
            margin: 0 0 2rem;
            text-align: center;
            justify-content: center;
        }

        .categories-title i {
            color: var(--help-primary);
        }

        .categories-grid {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .category-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            background: var(--help-glass);
            backdrop-filter: blur(20px);
            border: 2px solid var(--help-border);
            border-radius: var(--help-radius);
            color: var(--help-text);
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.95rem;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.05);
        }

        .category-btn:hover {
            background: white;
            border-color: var(--help-primary);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.15);
        }

        .category-btn.active {
            background: var(--help-gradient);
            border-color: var(--help-primary);
            color: white;
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        .category-btn i {
            font-size: 1.1rem;
        }

        /* FAQ Section */
        .faq-section {
            margin-bottom: 3rem;
        }

        .faq-grid {
            display: grid;
            gap: 1.5rem;
        }

        .faq-item {
            background: var(--help-glass);
            backdrop-filter: blur(20px);
            border: 1px solid var(--help-glass-border);
            border-radius: var(--help-radius);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.08);
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .faq-item:hover {
            box-shadow: var(--help-shadow-hover);
            border-color: rgba(239, 68, 68, 0.2);
            transform: translateY(-2px);
        }

        .faq-item.hidden {
            display: none;
        }

        .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2rem 2.5rem;
            cursor: pointer;
            background: transparent;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            user-select: none;
            position: relative;
        }

        .faq-question::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--help-gradient);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .faq-question:hover::before {
            transform: scaleX(1);
        }

        .faq-question:hover {
            background: rgba(239, 68, 68, 0.05);
        }

        .faq-question.active {
            background: var(--help-gradient);
            color: white;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        .faq-question.active::before {
            transform: scaleX(1);
            background: rgba(255, 255, 255, 0.3);
        }

        .question-content {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex: 1;
        }

        .question-icon {
            font-size: 1.75rem;
            flex-shrink: 0;
            filter: drop-shadow(0 1px 3px rgba(0, 0, 0, 0.1));
        }

        .question-text {
            font-size: 1.15rem;
            font-weight: 700;
            line-height: 1.4;
        }

        .toggle-icon {
            font-size: 1.3rem;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            flex-shrink: 0;
        }

        .faq-question.active .toggle-icon {
            transform: rotate(180deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .faq-answer.open {
            max-height: 600px;
        }

        .answer-content {
            padding: 2.5rem;
            border-top: 1px solid rgba(239, 68, 68, 0.1);
            background: rgba(248, 250, 252, 0.8);
            backdrop-filter: blur(10px);
        }

        .answer-content p {
            margin: 0 0 1.5rem;
            line-height: 1.7;
            color: var(--help-text);
            font-weight: 500;
        }

        .answer-content ol,
        .answer-content ul {
            margin: 1.5rem 0;
            padding-left: 1.5rem;
        }

        .answer-content li {
            margin: 0.75rem 0;
            line-height: 1.7;
            color: var(--help-text);
            font-weight: 500;
        }

        /* Info Boxes */
        .tip-box,
        .warning-box,
        .info-box {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1.5rem;
            border-radius: 1rem;
            margin: 1.5rem 0;
            font-size: 0.95rem;
            font-weight: 600;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .tip-box {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.05));
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #065f46;
        }

        .warning-box {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(245, 158, 11, 0.05));
            border: 1px solid rgba(245, 158, 11, 0.2);
            color: #92400e;
        }

        .info-box {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(59, 130, 246, 0.05));
            border: 1px solid rgba(59, 130, 246, 0.2);
            color: #1e40af;
        }

        .tip-box i,
        .warning-box i,
        .info-box i {
            margin-top: 0.1rem;
            flex-shrink: 0;
            font-size: 1.1rem;
        }

        /* Status badges */
        .status-available {
            color: var(--help-success);
            font-weight: 700;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .status-reserved {
            color: var(--help-warning);
            font-weight: 700;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .status-unavailable {
            color: var(--help-danger);
            font-weight: 700;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        /* Contact CTA */
        .contact-cta {
            text-align: center;
            padding: 4rem 3rem;
            background: var(--help-glass);
            backdrop-filter: blur(20px);
            border: 1px solid var(--help-glass-border);
            border-radius: 2rem;
            box-shadow: var(--help-shadow);
            position: relative;
            overflow: hidden;
        }

        .contact-cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--help-gradient);
            opacity: 0.05;
            pointer-events: none;
        }

        .cta-content {
            position: relative;
            z-index: 1;
        }

        .cta-content h3 {
            font-size: 2rem;
            font-weight: 900;
            color: var(--help-text);
            margin: 0 0 1rem;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .cta-content p {
            font-size: 1.2rem;
            color: var(--help-text-light);
            margin: 0 0 2.5rem;
            font-weight: 500;
        }

        .cta-button {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            padding: 1.25rem 2.5rem;
            background: var(--help-gradient);
            color: white;
            text-decoration: none;
            border-radius: var(--help-radius);
            font-weight: 800;
            font-size: 1.15rem;
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(239, 68, 68, 0.4);
            text-decoration: none;
            color: white;
        }

        .cta-button i {
            font-size: 1.25rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .help-container {
                padding: 1rem;
                background: linear-gradient(135deg, #fef2f2, #fee2e2);
            }

            .help-header {
                margin-bottom: 2rem;
                padding: 3rem 1.5rem;
            }

            .page-title {
                font-size: 2.5rem;
            }

            .header-icon {
                font-size: 3.5rem;
            }

            .categories-grid {
                flex-direction: column;
                align-items: center;
            }

            .category-btn {
                width: 100%;
                max-width: 350px;
                justify-content: center;
            }

            .faq-question {
                padding: 1.5rem 2rem;
            }

            .answer-content {
                padding: 2rem;
            }

            .question-text {
                font-size: 1rem;
            }

            .stats-section {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .stat-card {
                padding: 2rem 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .faq-question {
                padding: 1.25rem 1.5rem;
            }

            .question-content {
                gap: 1rem;
            }

            .question-icon {
                font-size: 1.5rem;
            }

            .question-text {
                font-size: 0.95rem;
            }

            .answer-content {
                padding: 1.5rem;
            }

            .contact-cta {
                padding: 3rem 2rem;
            }

            .cta-content h3 {
                font-size: 1.75rem;
            }

            .search-box input {
                padding: 1.25rem 1.25rem 1.25rem 3.5rem;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.toggleFAQ = function (element) {
                const question = element;
                const answer = question.nextElementSibling;
                const isOpen = answer.classList.contains('open');

                document.querySelectorAll('.faq-question').forEach(q => {
                    q.classList.remove('active');
                    q.nextElementSibling.classList.remove('open');
                });

                if (!isOpen) {
                    question.classList.add('active');
                    answer.classList.add('open');
                }
            };

            const searchInput = document.getElementById('faqSearch');
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    const searchTerm = this.value.toLowerCase();
                    const faqItems = document.querySelectorAll('.faq-item');

                    faqItems.forEach(item => {
                        const keywords = item.dataset.keywords || '';
                        const questionText = item.querySelector('.question-text').textContent;
                        const answerText = item.querySelector('.answer-content').textContent;

                        const searchContent = (keywords + ' ' + questionText + ' ' + answerText).toLowerCase();

                        if (searchContent.includes(searchTerm) || searchTerm === '') {
                            item.classList.remove('hidden');
                        } else {
                            item.classList.add('hidden');
                        }
                    });

                    updateCategoryCounts();
                });
            }

            const categoryButtons = document.querySelectorAll('.category-btn');
            categoryButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    const category = this.dataset.category;

                    categoryButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    const faqItems = document.querySelectorAll('.faq-item');
                    faqItems.forEach(item => {
                        if (category === 'all' || item.dataset.category === category) {
                            item.classList.remove('hidden');
                        } else {
                            item.classList.add('hidden');
                        }
                    });

                    if (searchInput) {
                        searchInput.value = '';
                    }
                });
            });

            function updateCategoryCounts() {
                const categories = ['all', 'account', 'books', 'system', 'support'];

                categories.forEach(cat => {
                    const btn = document.querySelector(`[data-category="${cat}"]`);
                    if (btn) {
                        let count;
                        if (cat === 'all') {
                            count = document.querySelectorAll('.faq-item:not(.hidden)').length;
                        } else {
                            count = document.querySelectorAll(`.faq-item[data-category="${cat}"]:not(.hidden)`).length;
                        }

                        const text = btn.textContent.replace(/\(\d+\)/, `(${count})`);
                        btn.textContent = text;
                    }
                });
            }

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    document.querySelectorAll('.faq-question').forEach(q => {
                        q.classList.remove('active');
                        q.nextElementSibling.classList.remove('open');
                    });
                }
            });

            if (window.location.hash) {
                const targetElement = document.querySelector(window.location.hash);
                if (targetElement) {
                    setTimeout(() => {
                        targetElement.scrollIntoView({ behavior: 'smooth' });
                        targetElement.querySelector('.faq-question').click();
                    }, 100);
                }
            }
        });
    </script>

@endsection