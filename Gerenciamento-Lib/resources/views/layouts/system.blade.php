<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Gerenciamento')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/system-modern.css') }}">

    @stack('styles')
</head>

<body>
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <a href="{{ route('home') }}">
                    <span style="font-size: 2rem;">📚</span>
                    <span>Sistema de Biblioteca</span>
                </a>
            </div>

            <div class="nav-menu">
                <a href="{{ route('home') }}">Início</a>
                <a href="{{ route('books.index') }}">Catálogo</a>

                @auth
                    @if(auth()->user()->isAdmin() || auth()->user()->isEmployee())
                        <a href="{{ route('stock.index') }}">Estoque</a>
                    @endif

                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('employees.index') }}">Funcionários</a>
                        <a href="{{ route('departments.index') }}">Departamentos</a>
                    @endif
                @endauth
            </div>

            <div class="nav-auth">
                @guest
                    <a href="{{ route('login') }}" class="auth-btn btn-login">
                        <span>🔐</span>
                        <span>Entrar</span>
                    </a>
                    <a href="{{ route('register') }}" class="auth-btn btn-register">
                        <span>✨</span>
                        <span>Criar Conta</span>
                    </a>
                @else
                    <div class="user-dropdown">
                        <button class="user-avatar" onclick="toggleUserMenu()">
                            <div class="avatar-circle">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="user-details">
                                <div class="user-name">{{ Auth::user()->name }}</div>
                                <div class="user-role">{{ ucfirst(Auth::user()->role) }}</div>
                            </div>
                            <div class="dropdown-arrow">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M7 10l5 5 5-5z" />
                                </svg>
                            </div>
                        </button>

                        <div class="user-menu" id="userMenu">
                            <div class="menu-header">
                                <div class="menu-avatar">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="menu-user-info">
                                    <div class="menu-name">{{ Auth::user()->name }}</div>
                                    <div class="menu-email">{{ Auth::user()->email }}</div>
                                    <div class="menu-role">{{ ucfirst(Auth::user()->role) }}</div>
                                </div>
                            </div>

                            <div class="menu-divider"></div>

                            <div class="menu-items">
                                <a href="{{ route('profile.show') }}" class="menu-item">
                                    <span class="menu-icon">👤</span>
                                    <span>Meu Perfil</span>
                                </a>

                                @if(!Auth::user()->isAdmin() && !Auth::user()->isEmployee())
                                    <a href="{{ route('contact.my-messages') }}" class="menu-item">
                                        <span class="menu-icon">💬</span>
                                        <span>Minhas Mensagens</span>
                                    </a>
                                    <a href="{{ route('contact.create') }}" class="menu-item">
                                        <span class="menu-icon">📞</span>
                                        <span>Fale Conosco</span>
                                    </a>
                                @endif

                                @if(Auth::user()->isAdmin() || (Auth::user()->isEmployee() && Auth::user()->employee && Auth::user()->employee->department && Auth::user()->employee->department->name === 'Atendimento'))
                                    <a href="{{ route('contact.manage') }}" class="menu-item">
                                        <span class="menu-icon">🎧</span>
                                        <span>Gerenciar Contatos</span>
                                    </a>
                                @endif
                                <a href="#" class="menu-item">
                                    <span class="menu-icon">⚙️</span>
                                    <span>Configurações</span>
                                </a>
                            </div>

                            <div class="menu-divider"></div>

                            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                                @csrf
                                <button type="submit" class="menu-item logout-item">
                                    <span class="menu-icon">🚪</span>
                                    <span>Sair</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                ✗ {{ session('error') }}
            </div>
        @endif

        @if(session('message'))
            <div class="alert alert-info">
                ℹ {{ session('message') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 1.5rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="content-wrapper">
            @yield('content')
        </div>
    </main>

    <footer class="modern-footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section footer-brand">
                    <div class="brand-logo">
                        <span class="brand-icon">📚</span>
                        <span class="brand-text">Sistema de Biblioteca</span>
                    </div>
                    <p class="brand-description">
                        Plataforma moderna e completa para gestão inteligente de bibliotecas.
                        Desenvolvido com tecnologia de ponta para oferecer a melhor experiência.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link" aria-label="Facebook">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#" class="social-link" aria-label="Instagram">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <a href="#" class="social-link" aria-label="LinkedIn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </a>
                        <a href="#" class="social-link" aria-label="YouTube">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                        </a>
                        <a href="#" class="social-link" aria-label="TikTok">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="footer-section">
                    <h4>Recursos</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('books.index') }}">Catálogo de Livros</a></li>
                        @auth
                            @if(auth()->user()->isAdmin() || auth()->user()->isEmployee())
                                <li><a href="{{ route('stock.index') }}">Controle de Estoque</a></li>
                            @endif
                            @if(auth()->user()->isAdmin())
                                <li><a href="{{ route('employees.index') }}">Gestão de Funcionários</a></li>
                                <li><a href="{{ route('departments.index') }}">Departamentos</a></li>
                            @endif
                        @endauth
                        <li><a href="#">Relatórios</a></li>
                        <li><a href="#">Análises</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Suporte</h4>
                    <ul class="footer-links">
                        <li><a href="#">Central de Ajuda</a></li>
                        <li><a href="#">Documentação</a></li>
                        <li><a href="#">Tutoriais</a></li>
                        <li><a href="#">API</a></li>
                        <li><a href="#">Status do Sistema</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Empresa</h4>
                    <ul class="footer-links">
                        <li><a href="#">Sobre Nós</a></li>
                        <li><a href="#">Nossa Missão</a></li>
                        <li><a href="#">Carreiras</a></li>
                        <li><a href="#">Imprensa</a></li>
                        <li><a href="#">Parcerias</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Legal</h4>
                    <ul class="footer-links">
                        <li><a href="#">Política de Privacidade</a></li>
                        <li><a href="#">Termos de Uso</a></li>
                        <li><a href="#">Cookies</a></li>
                        <li><a href="#">LGPD</a></li>
                        <li><a href="#">Licenças</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <div class="copyright">
                        <p>&copy; {{ date('Y') }} Sistema de Biblioteca. Todos os direitos reservados</p>
                    </div>
                    <div class="footer-bottom-links">
                        <a href="#">Política de Privacidade</a>
                        <span class="divider">•</span>
                        <a href="#">Termos de Uso</a>
                        <span class="divider">•</span>
                        <a href="#">Cookies</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')

    <script>
        function toggleUserMenu() {
            const menu = document.getElementById('userMenu');
            menu.classList.toggle('active');
        }

        document.addEventListener('click', function (event) {
            const userDropdown = document.querySelector('.user-dropdown');
            const userMenu = document.getElementById('userMenu');

            if (userDropdown && !userDropdown.contains(event.target)) {
                userMenu.classList.remove('active');
            }
        });

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);
    </script>
</body>

</html>