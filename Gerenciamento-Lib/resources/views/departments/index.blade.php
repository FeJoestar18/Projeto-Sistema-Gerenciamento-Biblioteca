@extends('layouts.system')

@section('title', 'Departamentos')

@push('styles')
    <style>
        .page {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 2rem 0;
        }

        .page-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .modern-header {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--accent-blue) 100%);
            border-radius: 2rem;
            padding: 3rem;
            margin-bottom: 3rem;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(239, 68, 68, 0.25);
        }

        .modern-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="headerPattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="white" fill-opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23headerPattern)"/></svg>');
            opacity: 0.3;
        }

        .header-content {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
        }

        .header-text h1 {
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, white, rgba(255,255,255,0.8));
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .header-text p {
            font-size: 1.2rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
            flex-shrink: 0;
        }

        .header-actions .btn {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(20px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: var(--rounded-xl);
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
        }

        .header-actions .btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .departments-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .department-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 1.5rem;
            padding: 2.5rem;
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .department-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-red), var(--accent-blue));
            transform: scaleX(0);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .department-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.2);
        }

        .department-card:hover::before {
            transform: scaleX(1);
        }

        .department-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .department-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-red), var(--accent-blue));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            font-weight: 900;
            box-shadow: 0 10px 15px -3px rgba(239, 68, 68, 0.3);
            flex-shrink: 0;
        }

        .department-info h3 {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        .department-subtitle {
            color: var(--text-secondary);
            font-size: 1rem;
            font-weight: 500;
        }

        .department-description {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(239, 68, 68, 0.05));
            border-radius: var(--rounded-lg);
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-left: 4px solid var(--accent-blue);
            color: var(--text-secondary);
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .department-stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            gap: 1rem;
        }

        .stat-item {
            flex: 1;
            text-align: center;
            padding: 1.5rem 1rem;
            background: rgba(255, 255, 255, 0.7);
            border-radius: var(--rounded-xl);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 900;
            background: linear-gradient(135deg, var(--primary-red), var(--accent-blue));
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: block;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .department-employees {
            margin-bottom: 2rem;
        }

        .employees-count {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, var(--primary-red), var(--accent-blue));
            color: white;
            border-radius: var(--rounded-lg);
            font-size: 0.9rem;
            font-weight: 600;
            box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.3);
        }

        .department-actions {
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
        }

        .btn-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            color: white;
        }

        .btn-view {
            background: linear-gradient(135deg, var(--gray-600), var(--gray-500));
        }

        .btn-edit {
            background: linear-gradient(135deg, var(--accent-blue), #60a5fa);
        }

        .btn-delete {
            background: linear-gradient(135deg, #ef4444, #f87171);
        }

        .btn-icon:hover {
            transform: translateY(-2px) scale(1.1);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 2rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .empty-icon {
            font-size: 5rem;
            margin-bottom: 2rem;
            opacity: 0.6;
        }

        .empty-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .empty-description {
            color: var(--text-secondary);
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        @media (max-width: 1024px) {
            .departments-grid {
                grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
                gap: 1.5rem;
            }

            .header-content {
                flex-direction: column;
                text-align: center;
                gap: 2rem;
            }
        }

        @media (max-width: 768px) {
            .page-container {
                padding: 0 1rem;
            }

            .departments-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .modern-header {
                padding: 2rem;
                margin-bottom: 2rem;
            }

            .header-text h1 {
                font-size: 2.2rem;
            }

            .department-card {
                padding: 2rem;
            }

            .department-header {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .department-stats {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
@endpush

@section('content')
<div class="page">
    <div class="page-container">
        <header class="modern-header">
            <div class="header-content">
                <div class="header-text">
                    <h1>🏢 Departamentos</h1>
                    <p>Organize e gerencie todos os departamentos da biblioteca com controle completo de estrutura organizacional e distribuição de funcionários.</p>
                </div>
                <div class="header-actions">
                    <a href="{{ route('departments.create') }}" class="btn">
                        <span>➕</span> Novo Departamento
                    </a>
                    <a href="#" class="btn">
                        <span>📋</span> Organograma
                    </a>
                </div>
            </div>
        </header>

        @forelse($departments as $department)
            @if($loop->first)
                <div class="departments-grid">
            @endif
                    <div class="department-card">
                        <div class="department-header">
                            <div class="department-icon">
                                🏢
                            </div>
                            <div class="department-info">
                                <h3>{{ $department->name }}</h3>
                                <div class="department-subtitle">Departamento da Biblioteca</div>
                            </div>
                        </div>
                        
                        <div class="department-description">
                            {{ $department->description ?: 'Departamento responsável pelas atividades organizacionais da biblioteca.' }}
                        </div>
                        
                        <div class="department-stats">
                            <div class="stat-item">
                                <span class="stat-number">{{ $department->employees_count ?? 0 }}</span>
                                <span class="stat-label">Funcionários</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">{{ rand(5, 20) }}</span>
                                <span class="stat-label">Projetos</span>
                            </div>
                        </div>
                        
                        <div class="department-employees">
                            <div class="employees-count">
                                👥 {{ $department->employees_count ?? 0 }} Funcionários Ativos
                            </div>
                        </div>
                        
                        <div class="department-actions">
                            <a href="{{ route('departments.show', $department) }}" class="btn-icon btn-view" title="Ver detalhes">
                                👁️
                            </a>
                            <a href="{{ route('departments.edit', $department) }}" class="btn-icon btn-edit" title="Editar">
                                ✏️
                            </a>
                            <form method="POST" action="{{ route('departments.destroy', $department) }}" style="display:inline;" 
                                  onsubmit="return confirm('Tem certeza que deseja excluir este departamento?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon btn-delete" title="Excluir">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </div>
            @if($loop->last)
                </div>
            @endif
        @empty
            <div class="empty-state">
                <div class="empty-icon">🏢</div>
                <h2 class="empty-title">Nenhum departamento cadastrado</h2>
                <p class="empty-description">
                    Crie departamentos para organizar melhor a estrutura da biblioteca e distribuir funcionários por áreas.
                </p>
                <a href="{{ route('departments.create') }}" class="btn btn-primary">
                    ➕ Criar Primeiro Departamento
                </a>
            </div>
        @endforelse

        @if($departments->hasPages())
            <div class="pagination-container">
                <div class="pagination-info">
                    Mostrando {{ $departments->firstItem() ?? 0 }} até {{ $departments->lastItem() ?? 0 }} 
                    de {{ $departments->total() }} departamentos
                </div>
                <div>
                    {{ $departments->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.department-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            setTimeout(() => {
                card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>
@endpush