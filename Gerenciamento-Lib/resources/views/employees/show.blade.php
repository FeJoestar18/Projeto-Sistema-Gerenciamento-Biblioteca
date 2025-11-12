@extends('layouts.system')

@section('title', $employee->name)

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>{{ $employee->name }}</h1>
            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-primary">Editar</a>
        </div>

        <div class="book-details">
            <div class="detail-section">
                <h3>Informações do Funcionário</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <label>Nome:</label>
                        <span>{{ $employee->name }}</span>
                    </div>
                    <div class="detail-item">
                        <label>Idade:</label>
                        <span>{{ $employee->age }} anos</span>
                    </div>
                    <div class="detail-item">
                        <label>E-mail:</label>
                        <span>{{ $employee->email }}</span>
                    </div>
                    <div class="detail-item">
                        <label>Departamento:</label>
                        <span>{{ $employee->department->name }}</span>
                    </div>
                    <div class="detail-item">
                        <label>CPF:</label>
                        <span>{{ $employee->cpf }}</span>
                    </div>
                    <div class="detail-item">
                        <label>RG:</label>
                        <span>{{ $employee->rg }}</span>
                    </div>
                </div>
            </div>

            <div class="detail-section">
                <h3>Endereço</h3>
                <p>{{ $employee->address }}</p>
            </div>

            <div class="detail-actions">
                <a href="{{ route('employees.index') }}" class="btn btn-secondary">← Voltar</a>
            </div>
        </div>
    </div>
@endsection