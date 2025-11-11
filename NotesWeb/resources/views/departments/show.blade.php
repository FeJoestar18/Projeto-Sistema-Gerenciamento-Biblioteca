@extends('layouts.system')

@section('title', $department->name)

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>{{ $department->name }}</h1>
            <a href="{{ route('departments.edit', $department) }}" class="btn btn-primary">Editar</a>
        </div>

        <div class="book-details">
            <div class="detail-section">
                <h3>Informações do Departamento</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <label>Nome:</label>
                        <span>{{ $department->name }}</span>
                    </div>
                    <div class="detail-item">
                        <label>Total de Funcionários:</label>
                        <span>{{ $department->employees->count() }}</span>
                    </div>
                </div>
            </div>

            @if($department->description)
                <div class="detail-section">
                    <h3>Descrição</h3>
                    <p>{{ $department->description }}</p>
                </div>
            @endif

            @if($department->employees->count() > 0)
                <div class="detail-section">
                    <h3>Funcionários</h3>
                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Idade</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($department->employees as $employee)
                                    <tr>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->age }}</td>
                                        <td>
                                            <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-view">Ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <div class="detail-actions">
                <a href="{{ route('departments.index') }}" class="btn btn-secondary">← Voltar</a>
            </div>
        </div>
    </div>
@endsection