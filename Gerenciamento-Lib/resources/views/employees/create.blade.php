@extends('layouts.system')

@section('title', 'Novo Funcionário')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Cadastrar Novo Funcionário</h1>
        </div>

        <div class="form-container">
            <form method="POST" action="{{ route('employees.store') }}" class="form">
                @csrf

                <div class="form-group">
                    <label for="name">Nome *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="age">Idade *</label>
                        <input type="number" id="age" name="age" value="{{ old('age') }}" min="18" max="100" required>
                        @error('age')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="department_id">Departamento *</label>
                        <select id="department_id" name="department_id" required>
                            <option value="">Selecione...</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Endereço *</label>
                    <textarea id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                    @error('address')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="cpf">CPF * (apenas números)</label>
                        <input type="text" id="cpf" name="cpf" value="{{ old('cpf') }}" maxlength="11" required>
                        @error('cpf')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="rg">RG *</label>
                        <input type="text" id="rg" name="rg" value="{{ old('rg') }}" required>
                        @error('rg')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">E-mail *</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Cadastrar Funcionário</button>
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection