@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <a href="{{route('books.create')}}">добавить книжульку</a>
                    <div class="card-header">Books</div>
                    <table class="table table-bordered">
                        @foreach($books as $book)
                            <tr>
                                <td>{{$book->id}}</td>
                                <td>{{$book->name}}</td>
                                <td>{{$book->price}}</td>
                                <td>
                                    <a href="{{route('books.edit', ['book' => $book])}}">edit</a>
                                    <a href="{{route('books.delete', ['id' => $book->id])}}">delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
