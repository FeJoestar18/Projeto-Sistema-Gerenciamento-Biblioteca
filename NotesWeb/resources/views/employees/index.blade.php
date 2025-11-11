@extends('layouts.system')

@section('title', 'Funcionários')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>👥 Funcionários</h1>
            <a href="{{ route('employees.create') }}" class="btn btn-primary">+ Novo Funcionário</a>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Idade</th>
                        <th>E-mail</th>
                        <th>Departamento</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        <tr>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->age }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->department->name }}</td>
                            <td class="actions">
                                <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-view">Ver</a>
                                <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-edit">Editar</a>
                                <form method="POST" action="{{ route('employees.destroy', $employee) }}"
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
                            <td colspan="5" class="text-center">Nenhum funcionário cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $employees->links() }}
        </div>
    </div>
@endsection