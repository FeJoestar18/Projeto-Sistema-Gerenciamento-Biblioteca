@extends('layouts.system')

@section('title', 'Sistema de Biblioteca - Início')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home-modern.css') }}">
@endpush

@section('content')
    <div class="home-container">
        <section class="hero-section">
            <div class="hero-content">
                <div class="hero-text animate-fade-in-up">
                    <h1>Sistema de Gerenciamento de Biblioteca</h1>
                    <p class="subtitle">
                        Transforme a gestão da sua biblioteca com nossa plataforma moderna,
                        intuitiva e completa. Controle total sobre acervo, funcionários e operações.
                    </p>
                    <div class="hero-buttons">
                        <a href="{{ route('books.index') }}" class="btn btn-primary">
                            <span>📖</span> Explorar Catálogo
                        </a>
                        @auth
                            @if(auth()->user()->isAdmin() || auth()->user()->isEmployee())
                                <a href="{{ route('stock.index') }}" class="btn btn-secondary">
                                    <span>📦</span> Gerenciar Estoque
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-secondary">
                                <span>🔐</span> Acessar Sistema
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="hero-visual">
                    <div class="library-illustration">
                        <div class="floating-elements">
                            <div class="book-stack book-1">📘</div>
                            <div class="book-stack book-2">📗</div>
                            <div class="book-stack book-3">📕</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="features-section">
            <div class="features-container animate-on-scroll">
                <h2>Recursos Avançados</h2>
                <p class="features-subtitle">
                    Descubra todas as funcionalidades que tornam nosso sistema a escolha ideal para sua biblioteca
                </p>

                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">📚</div>
                        <h3>Gestão Inteligente de Livros</h3>
                        <p>
                            Sistema completo de catalogação com ISBN único, categorização avançada
                            e busca inteligente para encontrar qualquer item rapidamente.
                        </p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">📊</div>
                        <h3>Controle de Estoque em Tempo Real</h3>
                        <p>
                            Monitore quantidades, movimentações e histórico completo com
                            relatórios detalhados e alertas automáticos de baixo estoque.
                        </p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">👥</div>
                        <h3>Gestão de Equipe</h3>
                        <p>
                            Administre funcionários e departamentos com controle de permissões
                            granular e acompanhamento de atividades em tempo real.
                        </p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">🔒</div>
                        <h3>Segurança Avançada</h3>
                        <p>
                            Proteção de dados com criptografia, auditoria completa de operações
                            e controle de acesso baseado em perfis de usuário.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-section">
            <div class="about-container">
                <div class="about-text animate-on-scroll">
                    <h2>Tecnologia de Ponta</h2>
                    <p>
                        Desenvolvido com <strong>Laravel 11</strong>, nossa plataforma utiliza as mais modernas
                        tecnologias web para oferecer performance excepcional, segurança robusta e
                        experiência do usuário premium.
                    </p>
                    <p>
                        Interface responsiva, operação em tempo real e arquitetura escalável
                        garantem que seu sistema cresça junto com sua biblioteca.
                    </p>

                    <div class="tech-stack">
                        <h3>Stack Tecnológico:</h3>
                        <div class="tech-badges">
                            <span class="tech-badge">Laravel 11</span>
                            <span class="tech-badge">PHP 8.2+</span>
                            <span class="tech-badge">MySQL</span>
                            <span class="tech-badge">Blade Engine</span>
                            <span class="tech-badge">CSS Grid</span>
                            <span class="tech-badge">REST API</span>
                        </div>
                    </div>
                </div>

                <div class="about-visual animate-on-scroll">
                    <div class="about-stats">
                        <div class="stat-item">
                            <span class="stat-number">100%</span>
                            <span class="stat-label">Seguro</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">15/11</span>
                            <span class="stat-label">Disponível</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">∞</span>
                            <span class="stat-label">Escalável</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">⚡</span>
                            <span class="stat-label">Rápido</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @auth
            <section class="quick-access">
                <div class="quick-access-container animate-on-scroll">
                    <h2>Acesso Rápido</h2>
                    <p class="quick-access-subtitle">
                        Navegue rapidamente pelas principais funcionalidades do sistema
                    </p>

                    <div class="stats-grid">
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('employees.index') }}" class="stat-card">
                                <span class="stat-icon">👥</span>
                                <span class="stat-label">Funcionários</span>
                            </a>
                            <a href="{{ route('departments.index') }}" class="stat-card">
                                <span class="stat-icon">🏢</span>
                                <span class="stat-label">Departamentos</span>
                            </a>
                        @endif

                        <a href="{{ route('books.index') }}" class="stat-card">
                            <span class="stat-icon">📚</span>
                            <span class="stat-label">Catálogo de Livros</span>
                        </a>

                        @if(auth()->user()->isAdmin() || auth()->user()->isEmployee())
                            <a href="{{ route('stock.index') }}" class="stat-card">
                                <span class="stat-icon">📦</span>
                                <span class="stat-label">Controle de Estoque</span>
                            </a>
                        @endif
                    </div>
                </div>
            </section>
        @endauth

        <section class="cta-section">
            <div class="cta-container animate-on-scroll">
                @auth
                    <h2>Continue Explorando</h2>
                    <p>Aproveite todos os recursos disponíveis para otimizar sua biblioteca</p>
                    <div class="cta-buttons">
                        <a href="{{ route('books.index') }}" class="btn btn-primary-outline">Ver Todo o Acervo</a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('employees.index') }}" class="btn btn-primary-outline">Gerenciar Equipe</a>
                        @endif
                    </div>
                @else
                    <h2>Pronto para Começar?</h2>
                    <p>Junte-se a centenas de bibliotecas que já utilizam nossa plataforma</p>
                    <div class="cta-buttons">
                        <a href="{{ route('register') }}" class="btn btn-primary-outline">Criar Conta Gratuita</a>
                        <a href="{{ route('login') }}" class="btn btn-primary-outline">Fazer Login</a>
                    </div>
                @endauth
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function (entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('in-view');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
@endsection