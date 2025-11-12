<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Gerenciamento')</title>
    <link rel="stylesheet" href="{{ asset('css/system.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    @stack('styles')
</head>

<body>
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <a href="{{ route('home') }}">📚 Sistema de Gerenciamento</a>
            </div>

            <div class="nav-menu">
                <a href="{{ route('home') }}">Início</a>
                <a href="{{ route('books.index') }}">Catálogo de Livros</a>

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
                    <a href="{{ route('login') }}" class="btn-login">Login</a>
                    <a href="{{ route('register') }}" class="btn-register">Cadastrar</a>
                @else
                    <span class="user-info">
                        {{ Auth::user()->name }}
                        <span class="user-role">({{ ucfirst(Auth::user()->role) }})</span>
                    </span>
                    <a href="{{ route('profile.show') }}" class="btn-profile">Perfil</a>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-logout">Sair</button>
                    </form>
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
            <div class="alert alert-error">
                ✗ {{ session('error') }}
            </div>
        @endif

        @if(session('message'))
            <div class="alert alert-info">
                ℹ {{ session('message') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-content">
            <p>&copy; {{ date('Y') }} Sistema de Gerenciamento. Todos os direitos reservados.</p>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>