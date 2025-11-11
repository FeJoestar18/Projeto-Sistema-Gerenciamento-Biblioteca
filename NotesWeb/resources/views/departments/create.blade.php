@extends('layouts.system')

@section('title', 'Novo Departamento')

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>Criar Novo Departamento</h1>
        </div>

        <div class="form-container">
            <form method="POST" action="{{ route('departments.store') }}" class="form">
                @csrf

                <div class="form-group">
                    <label for="name">Nome *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea id="description" name="description" rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Criar Departamento</button>
                    <a href="{{ route('departments.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection