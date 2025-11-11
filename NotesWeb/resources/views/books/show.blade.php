@extends('layouts.system')

@section('title', $book->title)

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>{{ $book->title }}</h1>
            @auth
                @if(auth()->user()->isAdmin() || auth()->user()->isEmployee())
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-primary">Editar</a>
                @endif
            @endauth
        </div>

        <div class="book-details">
            <div class="detail-section">
                <h3>Informações Básicas</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <label>Autor:</label>
                        <span>{{ $book->author }}</span>
                    </div>
                    <div class="detail-item">
                        <label>ISBN:</label>
                        <span>{{ $book->isbn }}</span>
                    </div>
                    <div class="detail-item">
                        <label>Categoria:</label>
                        <span class="badge">{{ $book->category }}</span>
                    </div>
                    <div class="detail-item">
                        <label>Quantidade em Estoque:</label>
                        <span class="{{ $book->inStock() ? 'text-success' : 'text-danger' }}">
                            {{ $book->quantity }} unidades
                        </span>
                    </div>
                    @if($book->price)
                        <div class="detail-item">
                            <label>Preço:</label>
                            <span>R$ {{ number_format($book->price, 2, ',', '.') }}</span>
                        </div>
                    @endif
                </div>
            </div>

            @if($book->description)
                <div class="detail-section">
                    <h3>Descrição</h3>
                    <p>{{ $book->description }}</p>
                </div>
            @endif

            @auth
                @if(auth()->user()->isAdmin() || auth()->user()->isEmployee())
                    <div class="detail-section">
                        <h3>Gerenciar Estoque</h3>
                        <div class="stock-actions">
                            <form method="POST" action="{{ route('stock.add', $book) }}" class="stock-form">
                                @csrf
                                <input type="number" name="quantity" min="1" placeholder="Quantidade" required>
                                <input type="text" name="notes" placeholder="Observações (opcional)">
                                <button type="submit" class="btn btn-success">+ Adicionar</button>
                            </form>

                            <form method="POST" action="{{ route('stock.remove', $book) }}" class="stock-form">
                                @csrf
                                <input type="number" name="quantity" min="1" max="{{ $book->quantity }}" placeholder="Quantidade"
                                    required>
                                <input type="text" name="notes" placeholder="Observações (opcional)">
                                <button type="submit" class="btn btn-danger">- Remover</button>
                            </form>
                        </div>
                        <a href="{{ route('stock.history', $book) }}" class="btn btn-secondary">Ver Histórico de Estoque</a>
                    </div>
                @endif
            @endauth

            <div class="detail-actions">
                <a href="{{ route('books.index') }}" class="btn btn-secondary">← Voltar ao Catálogo</a>
            </div>
        </div>
    </div>
@endsection