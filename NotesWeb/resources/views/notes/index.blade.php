@extends('layouts.app')

@section('content')
<div class="notes-container">
    <div class="header">
        <h1>{{ $viewTitle ?? 'Notas' }}</h1>
        <a href="{{ route('notes.create') }}" class="btn-create">
            <span class="icon">+</span> Nova Nota
        </a>
    </div>

    <div class="search-container">
        <form action="{{ route('notes.index') }}" method="GET" class="search-form">
            <div class="search-input-wrapper">
                <input type="text" name="search" placeholder="Buscar notas..." value="{{ request('search') }}">
                <button type="submit" class="search-button">
                    <span class="search-icon">🔍</span>
                </button>
            </div>
            @if(request('search'))
                <a href="{{ route('notes.index') }}" class="clear-search">Limpar busca</a>
            @endif
        </form>
    </div>

    <div class="notes-list">
        @foreach($notes as $note)
            <div class="note-card {{ $note->is_public ? 'public-note' : 'private-note' }}">
                <div class="note-content">
                    <div class="note-header">
                        <a href="{{ route('notes.show', $note) }}" class="note-title">{{ $note->title }}</a>
                        <span class="visibility-badge {{ $note->is_public ? 'public' : 'private' }}">
                            {{ $note->is_public ? 'Pública' : 'Privada' }}
                        </span>
                    </div>
                    <div class="note-author">
                        @if($note->isAnonymous())
                            Por: <span class="anonymous">Usuário Anônimo</span>
                        @elseif($note->user)
                            Por: {{ $note->user->name }}
                        @else
                            Por: <span class="unknown">Usuário não encontrado</span>
                        @endif
                    </div>
                </div>
                <div class="note-actions">
                    @if(Auth::check() && $note->user_id === Auth::id())
                        <a href="{{ route('notes.edit', $note) }}" class="btn-edit">Editar</a>
                        <form action="{{ route('notes.destroy', $note) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Excluir</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach

        @if(count($notes) === 0)
            <div class="empty-state">
                <div class="icon">📝</div>
                <p>Nenhuma nota encontrada.</p>
                @auth
                    <p>Crie sua primeira nota agora!</p>
                @else
                    <p>Crie uma nota pública ou faça login para acessar notas privadas!</p>
                @endauth
            </div>
        @endif
    </div>
</div>
@endsection
