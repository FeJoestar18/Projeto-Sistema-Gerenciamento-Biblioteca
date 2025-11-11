@extends('layouts.system')

@section('title', 'Editar Departamento')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Editar Departamento: {{ $department->name }}</h1>
        </div>

        <div class="form-container">
            <form method="POST" action="{{ route('departments.update', $department) }}" class="form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nome *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $department->name) }}" required>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea id="description" name="description"
                        rows="4">{{ old('description', $department->description) }}</textarea>
                    @error('description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Atualizar Departamento</button>
                    <a href="{{ route('departments.show', $department) }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection