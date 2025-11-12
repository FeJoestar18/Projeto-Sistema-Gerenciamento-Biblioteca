<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StockOperationRequest;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('title')->paginate(15);
        return view('stock.index', compact('books'));
    }

    public function add(StockOperationRequest $request, Book $book)
    {
        $this->authorize('manageStock', $book);

        if ($book->addStock($request->quantity, auth()->user(), $request->notes)) {
            return back()->with('success', 'Estoque adicionado com sucesso!');
        }

        return back()->with('error', 'Erro ao adicionar estoque.');
    }

    public function remove(StockOperationRequest $request, Book $book)
    {
        $this->authorize('manageStock', $book);

        if ($book->removeStock($request->quantity, auth()->user(), $request->notes)) {
            return back()->with('success', 'Estoque removido com sucesso!');
        }

        return back()->with('error', 'Quantidade insuficiente em estoque.');
    }

    public function history(Book $book)
    {
        $this->authorize('manageStock', $book);
        $logs = $book->stockLogs()->with('user')->latest()->paginate(20);

        return view('stock.history', compact('book', 'logs'));
    }
}
