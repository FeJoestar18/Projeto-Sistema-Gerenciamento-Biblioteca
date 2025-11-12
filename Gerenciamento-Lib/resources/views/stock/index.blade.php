@extends('layouts.system')

@section('title', 'Gerenciamento de Estoque')

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

        /* Cards de Estoque */
        .stock-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .stock-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 1.5rem;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .stock-card::before {
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

        .stock-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.2);
        }

        .stock-card:hover::before {
            transform: scaleX(1);
        }

        .stock-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-red), var(--accent-blue));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            font-weight: 900;
            margin-bottom: 1.5rem;
            box-shadow: 0 10px 15px -3px rgba(239, 68, 68, 0.3);
        }

        .stock-title {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        .stock-meta {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .stock-meta span {
            display: block;
            margin-bottom: 0.25rem;
        }

        .stock-quantity {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(239, 68, 68, 0.05));
            border-radius: var(--rounded-lg);
            border: 1px solid rgba(59, 130, 246, 0.1);
        }

        .quantity-label {
            font-weight: 600;
            color: var(--text-primary);
        }

        .quantity-value {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-red), var(--accent-blue));
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stock-status {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .badge {
            padding: 0.5rem 1rem;
            border-radius: var(--rounded-lg);
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .badge-success {
            background: linear-gradient(135deg, #10b981, #34d399);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3);
        }

        .badge-danger {
            background: linear-gradient(135deg, #ef4444, #f87171);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.3);
        }

        .badge-warning {
            background: linear-gradient(135deg, #f59e0b, #fbbf24);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(245, 158, 11, 0.3);
        }

        .stock-actions {
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

        .btn-history {
            background: linear-gradient(135deg, var(--accent-blue), #60a5fa);
        }

        .btn-icon:hover {
            transform: translateY(-2px) scale(1.1);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        /* Estado vazio */
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

        /* Responsividade */
        @media (max-width: 1024px) {
            .stock-grid {
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

            .stock-grid {
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

            .stock-card {
                padding: 1.5rem;
            }
        }
    </style>
@endpush

@section('content')
<div class="page">
    <div class="page-container">
        <!-- Header Moderno -->
        <header class="modern-header">
            <div class="header-content">
                <div class="header-text">
                    <h1>📦 Gerenciamento de Estoque</h1>
                    <p>Monitore e controle o estoque de todos os livros da biblioteca em tempo real com relatórios detalhados e alertas de baixo estoque.</p>
                </div>
                <div class="header-actions">
                    <a href="{{ route('books.create') }}" class="btn">
                        <span>➕</span> Adicionar Livro
                    </a>
                    <a href="#" class="btn">
                        <span>📊</span> Relatórios
                    </a>
                </div>
            </div>
        </header>

        @forelse($books as $book)
            @if($loop->first)
                <div class="stock-grid">
            @endif
                    <div class="stock-card">
                        <div class="stock-icon">
                            📦
                        </div>
                        <h3 class="stock-title">{{ $book->title }}</h3>
                        <div class="stock-meta">
                            <span><strong>📖 ISBN:</strong> {{ $book->isbn }}</span>
                            <span><strong>📚 Categoria:</strong> {{ $book->category }}</span>
                            <span><strong>✍️ Autor:</strong> {{ $book->author }}</span>
                        </div>
                        
                        <div class="stock-quantity">
                            <span class="quantity-label">Quantidade em Estoque:</span>
                            <span class="quantity-value">{{ $book->quantity }}</span>
                        </div>
                        
                        <div class="stock-status">
                            @if($book->quantity > 10)
                                <span class="badge badge-success">
                                    ✅ Estoque Alto
                                </span>
                            @elseif($book->quantity > 5)
                                <span class="badge badge-warning">
                                    ⚠️ Estoque Baixo
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    ❌ Estoque Crítico
                                </span>
                            @endif
                            
                            <span class="badge badge-{{ $book->inStock() ? 'success' : 'danger' }}">
                                {{ $book->inStock() ? '✅ Disponível' : '❌ Esgotado' }}
                            </span>
                        </div>
                        
                        <div class="stock-actions">
                            <a href="{{ route('books.show', $book) }}" class="btn-icon btn-view" title="Ver detalhes">
                                👁️
                            </a>
                            <a href="{{ route('stock.history', $book) }}" class="btn-icon btn-history" title="Histórico">
                                📋
                            </a>
                        </div>
                    </div>
            @if($loop->last)
                </div>
            @endif
        @empty
            <div class="empty-state">
                <div class="empty-icon">📦</div>
                <h2 class="empty-title">Nenhum item em estoque</h2>
                <p class="empty-description">
                    Adicione livros ao catálogo para começar a gerenciar o estoque da biblioteca.
                </p>
                <a href="{{ route('books.create') }}" class="btn btn-primary">
                    ➕ Adicionar Primeiro Livro
                </a>
            </div>
        @endforelse

        @if($books->hasPages())
            <div class="pagination-container">
                <div class="pagination-info">
                    Mostrando {{ $books->firstItem() ?? 0 }} até {{ $books->lastItem() ?? 0 }} 
                    de {{ $books->total() }} itens
                </div>
                <div>
                    {{ $books->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.stock-card');
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