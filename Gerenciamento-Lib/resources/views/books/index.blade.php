@extends('layouts.system')

@section('title', 'Catálogo de Livros')

@push('styles')
    <style>
        .books-page {
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

        .filters-container {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border-radius: 2rem;
            padding: 2rem;
            margin-bottom: 3rem;
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .filters-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto;
            gap: 1.5rem;
            align-items: end;
        }

        .filter-group {
            position: relative;
        }

        .filter-label {
            display: block;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .filter-input {
            width: 100%;
            padding: 1rem 1.5rem;
            border: 2px solid var(--gray-200);
            border-radius: var(--rounded-xl);
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
        }

        .filter-input:focus {
            outline: none;
            border-color: var(--primary-red);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .search-input {
            position: relative;
        }

        .search-input::before {
            content: '🔍';
            position: absolute;
            left: 1.5rem;
            top: 3.2rem;
            font-size: 1.2rem;
            z-index: 2;
        }

        .search-input .filter-input {
            padding-left: 3.5rem;
        }

        .filter-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .book-card {
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

        .book-card::before {
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

        .book-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.2);
        }

        .book-card:hover::before {
            transform: scaleX(1);
        }

        .book-icon {
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

        .book-title {
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        .book-meta {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .book-meta span {
            display: block;
            margin-bottom: 0.25rem;
        }

        .book-badges {
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

        .badge-info {
            background: linear-gradient(135deg, var(--accent-blue), #60a5fa);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
        }

        .book-actions {
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

        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 1.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .pagination-info {
            color: var(--text-secondary);
            font-weight: 500;
        }

        @media (max-width: 1024px) {
            .filters-grid {
                grid-template-columns: 1fr 1fr;
                gap: 1rem;
            }

            .filter-actions {
                grid-column: 1 / -1;
                margin-top: 1rem;
            }

            .books-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
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

            .filters-grid {
                grid-template-columns: 1fr;
            }

            .books-grid {
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

            .book-card {
                padding: 1.5rem;
            }
        }
    </style>
@endpush

@section('content')
<div class="books-page">
    <div class="page-container">
        <header class="modern-header">
            <div class="header-content">
                <div class="header-text">
                    <h1>📚 Catálogo de Livros</h1>
                    <p>Explore nossa coleção completa de livros disponíveis na biblioteca. Use os filtros abaixo para encontrar exatamente o que procura.</p>
                </div>
                <div class="header-actions">
                    @auth
                        @if(auth()->user()->isAdmin() || auth()->user()->isEmployee())
                            <a href="{{ route('books.create') }}" class="btn">
                                <span>➕</span> Adicionar Livro
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </header>

        <div class="filters-container">
            <form method="GET" action="{{ route('books.index') }}">
                <div class="filters-grid">
                    <div class="filter-group search-input">
                        <label class="filter-label">Buscar Livros</label>
                        <input type="text" 
                               name="search" 
                               class="filter-input" 
                               placeholder="Buscar por título, autor, ISBN..." 
                               value="{{ request('search') }}">
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Categoria</label>
                        <select name="category" class="filter-input">
                            <option value="">Todas as categorias</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Ordenar por</label>
                        <select name="sort" class="filter-input">
                            <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Título A-Z</option>
                            <option value="author" {{ request('sort') == 'author' ? 'selected' : '' }}>Autor A-Z</option>
                            <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Mais Recentes</option>
                            <option value="category" {{ request('sort') == 'category' ? 'selected' : '' }}>Categoria</option>
                        </select>
                    </div>

                    <div class="filter-actions">
                        <button type="submit" class="btn btn-primary">
                            🔍 Buscar
                        </button>
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">
                            🔄 Limpar
                        </a>
                    </div>
                </div>
            </form>
        </div>

        @forelse($books as $book)
            @if($loop->first)
                <div class="books-grid">
            @endif
                    <div class="book-card">
                        <div class="book-icon">
                            {{ strtoupper(substr($book->title, 0, 1)) }}
                        </div>
                        <h3 class="book-title">{{ $book->title }}</h3>
                        <div class="book-meta">
                            <span><strong>✍️ Autor:</strong> {{ $book->author }}</span>
                            <span><strong>📚 Categoria:</strong> {{ $book->category }}</span>
                            <span><strong>📖 ISBN:</strong> {{ $book->isbn }}</span>
                        </div>
                        <div class="book-badges">
                            @if($book->inStock())
                                <span class="badge badge-success">
                                    ✅ {{ $book->quantity }} em estoque
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    ❌ Fora de estoque
                                </span>
                            @endif
                            @if($book->price)
                                <span class="badge badge-info">
                                    💰 R$ {{ number_format($book->price, 2, ',', '.') }}
                                </span>
                            @endif
                        </div>
                        <div class="book-actions">
                            <a href="{{ route('books.show', $book) }}" class="btn-icon btn-view" title="Ver detalhes">
                                👁️
                            </a>
                            @auth
                                @if(auth()->user()->isAdmin() || auth()->user()->isEmployee())
                                    <a href="{{ route('books.edit', $book) }}" class="btn-icon btn-edit" title="Editar">
                                        ✏️
                                    </a>
                                    <form method="POST" action="{{ route('books.destroy', $book) }}" style="display:inline;" 
                                          onsubmit="return confirm('Tem certeza que deseja excluir este livro?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon btn-delete" title="Excluir">
                                            🗑️
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
            @if($loop->last)
                </div>
            @endif
        @empty
            <div class="empty-state">
                <div class="empty-icon">📚</div>
                <h2 class="empty-title">Nenhum livro encontrado</h2>
                <p class="empty-description">
                    Tente ajustar os filtros ou adicionar novos livros ao catálogo.
                </p>
                @auth
                    @if(auth()->user()->isAdmin() || auth()->user()->isEmployee())
                        <a href="{{ route('books.create') }}" class="btn btn-primary">
                            ➕ Adicionar Primeiro Livro
                        </a>
                    @endif
                @endauth
            </div>
        @endforelse

        @if($books->hasPages())
            <div class="pagination-container">
                <div class="pagination-info">
                    Mostrando {{ $books->firstItem() ?? 0 }} até {{ $books->lastItem() ?? 0 }} 
                    de {{ $books->total() }} resultados
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
        const form = document.querySelector('.filters-container form');
        const selects = form.querySelectorAll('select');
        
        selects.forEach(select => {
            select.addEventListener('change', function() {
                form.submit();
            });
        });

        const cards = document.querySelectorAll('.book-card');
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