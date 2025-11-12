@extends('layouts.system')

@section('title', 'Gerenciar Estoque')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>📦 Gerenciamento de Estoque</h1>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>ISBN</th>
                        <th>Categoria</th>
                        <th>Quantidade</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ $book->category }}</td>
                            <td>{{ $book->quantity }}</td>
                            <td>
                                <span class="badge {{ $book->inStock() ? 'badge-success' : 'badge-danger' }}">
                                    {{ $book->inStock() ? 'Disponível' : 'Esgotado' }}
                                </span>
                            </td>
                            <td class="actions">
                                <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-primary">Gerenciar</a>
                                <a href="{{ route('stock.history', $book) }}" class="btn btn-sm btn-secondary">Histórico</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Nenhum livro cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $books->links() }}
        </div>
    </div>
@endsection