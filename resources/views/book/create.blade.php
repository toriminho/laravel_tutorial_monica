@extends('book/layout/book')

@section('header')
        <div class="col-md-6">
            <h1>書籍登録</h1>
        </div>
@endsection
@section('content')
@include('book/parts/form', ['target' => 'store'])
@endsection
