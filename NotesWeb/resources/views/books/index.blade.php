@extends('layouts.system')

@section('title', 'Catálogo de Livros')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>📚 Catálogo de Livros</h1>
            @auth
                @if(auth()->user()->isAdmin() || auth()->user()->isEmployee())
                    <a href="{{ route('books.create') }}" class="btn btn-primary">+ Novo Livro</a>
                @endif
            @endauth
        </div>

        <div class="search-filter">
            <form method="GET" action="{{ route('books.index') }}" class="search-form">
                <input type="text" name="search" placeholder="Buscar por título, autor..." value="{{ request('search') }}">

                <select name="category">
                    <option value="">Todas as categorias</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-search">Buscar</button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Limpar</a>
            </form>

            @auth
                <div class="export-actions">
                    <a href="{{ route('export.books') }}" class="btn btn-export">📥 Exportar CSV</a>
                </div>
            @endauth
        </div>

        <div class="books-grid">
            @forelse($books as $book)
                <div class="book-card">
                    <div class="book-header">
                        <h3>{{ $book->title }}</h3>
                        <span class="book-category">{{ $book->category }}</span>
                    </div>

                    <div class="book-info">
                        <p><strong>Autor:</strong> {{ $book->author }}</p>
                        <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
                        <p class="book-stock {{ $book->inStock() ? 'in-stock' : 'out-stock' }}">
                            <strong>Estoque:</strong> {{ $book->quantity }} unidades
                        </p>
                        @if($book->price)
                            <p><strong>Preço:</strong> R$ {{ number_format($book->price, 2, ',', '.') }}</p>
                        @endif
                    </div>

                    <div class="book-actions">
                        <a href="{{ route('books.show', $book) }}" class="btn btn-view">Ver Detalhes</a>

                        @auth
                            @if(auth()->user()->isAdmin() || auth()->user()->isEmployee())
                                <a href="{{ route('books.edit', $book) }}" class="btn btn-edit">Editar</a>
                                <form method="POST" action="{{ route('books.destroy', $book) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete"
                                        onclick="return confirm('Deseja excluir este livro?')">Excluir</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <p>Nenhum livro encontrado.</p>
                </div>
            @endforelse
        </div>

        <div class="pagination">
            {{ $books->links() }}
        </div>
    </div>
@endsection