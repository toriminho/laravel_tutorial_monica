@extends('book/layout/book')

@section('content')
@include('book/layout/form', ['target' => 'update'])
@endsection