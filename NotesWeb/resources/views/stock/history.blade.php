@extends('layouts.system')

@section('title', 'Histórico de Estoque')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>📜 Histórico de Estoque - {{ $book->title }}</h1>
            <a href="{{ route('books.show', $book) }}" class="btn btn-secondary">← Voltar</a>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Tipo</th>
                        <th>Quantidade</th>
                        <th>Estoque Anterior</th>
                        <th>Novo Estoque</th>
                        <th>Usuário</th>
                        <th>Observações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge {{ $log->type == 'add' ? 'badge-success' : 'badge-danger' }}">
                                    {{ $log->type == 'add' ? 'Adição' : 'Remoção' }}
                                </span>
                            </td>
                            <td>{{ $log->quantity }}</td>
                            <td>{{ $log->previous_quantity }}</td>
                            <td>{{ $log->new_quantity }}</td>
                            <td>{{ $log->user->name }}</td>
                            <td>{{ $log->notes ?: '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Nenhum registro de movimentação.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $logs->links() }}
        </div>
    </div>
@endsection