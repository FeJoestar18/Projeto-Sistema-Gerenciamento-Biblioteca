@extends('layouts.system')

@section('title', 'Departamentos')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>🏢 Departamentos</h1>
            <a href="{{ route('departments.create') }}" class="btn btn-primary">+ Novo Departamento</a>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Funcionários</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($departments as $department)
                        <tr>
                            <td>{{ $department->name }}</td>
                            <td>{{ $department->description }}</td>
                            <td>{{ $department->employees_count }}</td>
                            <td class="actions">
                                <a href="{{ route('departments.show', $department) }}" class="btn btn-sm btn-view">Ver</a>
                                <a href="{{ route('departments.edit', $department) }}" class="btn btn-sm btn-edit">Editar</a>
                                <form method="POST" action="{{ route('departments.destroy', $department) }}"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-delete"
                                        onclick="return confirm('Deseja excluir?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Nenhum departamento cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $departments->links() }}
        </div>
    </div>
@endsection