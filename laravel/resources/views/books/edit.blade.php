@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add book</div>
                    <form action="{{route('books.save', ['id' => $book->id])}}" method="post">
                        @csrf
                        <table class="table table-bordered">
                            <tr>
                                <td>name</td>
                                <td>
                                    <input type="text" name="name" value="{{$book->name}}">
                                    @if ($errors->has('name'))
                                        <div class="alert alert-danger">{{$errors->first('name')}}</div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>price</td>
                                <td>
                                    <input type="text" name="price" value="{{$book->price}}">
                                    @if ($errors->has('price'))
                                        <div class="alert alert-danger">{{$errors->first('price')}}</div>
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <input type="submit" value="сохранить">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection