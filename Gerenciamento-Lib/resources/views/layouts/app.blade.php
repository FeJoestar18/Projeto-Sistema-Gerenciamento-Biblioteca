<!doctype html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloco de Notas</title>
    <link rel="stylesheet" href="{{ asset('css/layouts/topbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/notes/create.css') }}">
    <link rel="stylesheet" href="{{ asset('css/notes/edit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/notes/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/auth.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="topbar">
    <div class="logo">📝 Web Notes</div>

    <div class="main-menu">
        <a href="{{ route('home') }}">Início</a>

    </div>

    <div class="auth-links">
        @guest
            <a href="{{ route('login') }}" class="login">Login</a>
            <a href="{{ route('register') }}" class="register">Cadastrar</a>
        @else
            <span class="user-greeting">Olá, {{ Auth::user()->name }}</span>
            <a href="{{ route('profile.show') }}" class="profile-link">Meu Perfil</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="logout-btn">Sair</button>
            </form>
        @endguest
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@yield('content')
</body>
</html>
