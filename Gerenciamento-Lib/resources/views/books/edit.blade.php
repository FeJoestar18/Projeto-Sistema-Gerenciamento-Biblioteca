@extends('layouts.system')

@section('title', 'Editar Livro')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Editar Livro: {{ $book->title }}</h1>
        </div>

        <div class="form-container">
            <form method="POST" action="{{ route('books.update', $book) }}" class="form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Título *</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" required>
                    @error('title')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="author">Autor *</label>
                    <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" required>
                    @error('author')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="isbn">ISBN *</label>
                        <input type="text" id="isbn" name="isbn" value="{{ old('isbn', $book->isbn) }}" required>
                        @error('isbn')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category">Categoria *</label>
                        <input type="text" id="category" name="category" value="{{ old('category', $book->category) }}"
                            required>
                        @error('category')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="quantity">Quantidade *</label>
                        <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $book->quantity) }}"
                            min="0" required>
                        @error('quantity')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">Preço (R$)</label>
                        <input type="number" id="price" name="price" value="{{ old('price', $book->price) }}" step="0.01"
                            min="0">
                        @error('price')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea id="description" name="description"
                        rows="4">{{ old('description', $book->description) }}</textarea>
                    @error('description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Atualizar Livro</button>
                    <a href="{{ route('books.show', $book) }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection