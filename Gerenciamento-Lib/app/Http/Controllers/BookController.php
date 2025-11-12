<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }
        if ($request->has('category') && $request->get('category') !== '') {
            $query->where('category', $request->get('category'));
        }

        $books = $query->paginate(12);
        $categories = Book::distinct()->pluck('category');

        return view('books.index', compact('books', 'categories'));
    }

    public function create()
    {
        $this->authorize('create', Book::class);
        return view('books.create');
    }

    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->id();

        Book::create($data);
        return redirect()->route('books.index')->with('success', 'Livro cadastrado com sucesso!');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $this->authorize('update', $book);
        return view('books.edit', compact('book'));
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update($request->validated());
        return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Livro excluído com sucesso!');
    }
}
