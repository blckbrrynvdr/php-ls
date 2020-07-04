<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\BookRequest;
use App\Mail\BookEdit;
use App\Mail\Test;
use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\Mail;

class BookController extends Controller
{
    function index(Request $request)
    {
//        Debugbar::info($request);
//        Debugbar::error('!Error!');
//        Debugbar::warning('Ooooops...');
//        Debugbar::addMessage('Another message', 'mylabel');
        $books = Book::query()->orderBy('id', 'DESC')->get();
        return view('books.list', ['books' => $books]);
    }

    function create()
    {
        return view('books.create');
    }

    function add(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',
            'price' => 'numeric'
        ]);

        $book = new Book();
        $book->name = $request->name;
        $book->price = $request->price;
        $book->save();
        return redirect()->route('books');
    }

    function edit(Book $book)
    {
//        return view('books.edit');
//        Mail::to(\Auth::user())->send(new BookEdit(['book' => $book]));
        return view('books.edit', ['book' => $book]);
    }

    function save(BookRequest $request)
    {
        $book = Book::query()->find($request->id);


        $book->name = $request->name;
        $book->price = $request->price;
        $book->save();
        return redirect()->route('books');
    }

    function delete(Request $request)
    {
        Book::destroy($request->id);
        return redirect()->route('books');
    }
}