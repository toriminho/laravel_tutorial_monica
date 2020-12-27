@extends('book/layout/book')

@section('header')
        <div class="col-md-6">
            <h1>書籍編集</h1>
        </div>
@endsection
@section('content')
@include('book/parts/form', ['target' => 'update'])
@endsection