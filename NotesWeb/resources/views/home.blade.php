@extends('layouts.system')

@section('title', 'Bem-vindo')

@section('content')
<link rel="stylesheet" href="{{ asset('css/home-library.css') }}">
<div class="home-container">
    <div class="hero-section">
        <div class="hero-content">
            <h1>📚 Sistema de Gerenciamento de Biblioteca</h1>
            <p class="subtitle">Gerencie livros, funcionários, departamentos e estoque de forma eficiente.</p>
            <div class="hero-buttons">
                <a href="{{ route('books.index') }}" class="btn btn-primary">
                    <span class="icon">📖</span> Ver Catálogo de Livros
                </a>
                @auth
                    @if(auth()->user()->isAdmin() || auth()->user()->isEmployee())
                        <a href="{{ route('stock.index') }}" class="btn btn-secondary">
                            <span class="icon">�</span> Gerenciar Estoque
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-secondary">
                        <span class="icon">🔐</span> Fazer Login
                    </a>
                @endauth
            </div>
        </div>
        <div class="hero-image">
            <div class="library-illustration">
                <div class="book-stack book-1">�</div>
                <div class="book-stack book-2">�</div>
                <div class="book-stack book-3">📕</div>
            </div>
        </div>
    </div>

    <div class="features-section">
        <h2>Recursos do Sistema</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">�</div>
                <h3>Gestão de Livros</h3>
                <p>Cadastre, edite e organize seu acervo de livros com ISBN único e categorização.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">�</div>
                <h3>Controle de Estoque</h3>
                <p>Gerencie a quantidade de livros disponíveis com histórico completo de movimentações.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">�</div>
                <h3>Gestão de Funcionários</h3>
                <p>Administre funcionários e departamentos com controle de permissões.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🔒</div>
                <h3>Segurança e Auditoria</h3>
                <p>Dados criptografados e registro completo de todas as operações do sistema.</p>
            </div>
        </div>
    </div>

    <div class="about-section">
        <div class="about-content">
            <h2>Sobre o Sistema</h2>
            <p>O <strong>Sistema de Gerenciamento de Biblioteca</strong> é uma solução completa desenvolvida em Laravel 11 para administração de bibliotecas e livrarias. Oferece controle total sobre livros, funcionários, departamentos e estoque com recursos avançados de segurança e auditoria.</p>
            <p>Sistema desenvolvido seguindo as melhores práticas Laravel, com autenticação segura, criptografia de dados sensíveis, validações robustas e interface moderna com tema vermelho e preto.</p>
            
            @auth
                <div class="quick-stats">
                    <h3>Acesso Rápido:</h3>
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
                            <span class="stat-label">Catálogo</span>
                        </a>
                        @if(auth()->user()->isAdmin() || auth()->user()->isEmployee())
                            <a href="{{ route('stock.index') }}" class="stat-card">
                                <span class="stat-icon">📦</span>
                                <span class="stat-label">Estoque</span>
                            </a>
                        @endif
                    </div>
                </div>
            @else
                <div class="cta-section">
                    <h3>Comece Agora!</h3>
                    <p>Faça login ou cadastre-se para acessar todas as funcionalidades do sistema.</p>
                    <div class="cta-buttons">
                        <a href="{{ route('login') }}" class="btn btn-primary">Fazer Login</a>
                        <a href="{{ route('register') }}" class="btn btn-secondary">Cadastrar-se</a>
                    </div>
                </div>
            @endauth
            
            <div class="tech-stack">
                <h3>Tecnologias utilizadas:</h3>
                <div class="tech-badges">
                    <span class="tech-badge">Laravel 11</span>
                    <span class="tech-badge">PHP 8.2+</span>
                    <span class="tech-badge">MySQL</span>
                    <span class="tech-badge">Blade Templates</span>
                    <span class="tech-badge">CSS3</span>
                </div>
            </div>
        </div>
    </div>

    <div class="cta-section">
        <h2>Comece a usar agora mesmo</h2>
        <p>Explore nosso catálogo de livros e gerencie seu acervo de forma eficiente.</p>
        <div class="cta-buttons">
            <a href="{{ route('books.index') }}" class="btn-primary">Explorar Catálogo</a>
            <a href="{{ route('register') }}" class="btn-secondary">Criar Conta</a>
        </div>
    </div>
</div>
@endsection
