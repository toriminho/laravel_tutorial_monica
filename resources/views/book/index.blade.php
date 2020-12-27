@extends('book/layout/book')

@section('header')
  <div class="col-md-12">
    <h1 class="ops-title">書籍一覧</h1>
  </div>
@endsection

@section('content')
<div class="row">
  <div class="col-md-11 col-md-offset-1">
    <table class="table text-center">
      <thead>
        <tr>
          <th class="text-center">ID</th>
          <th class="text-center">書籍名</th>
          <th class="text-center">価格</th>
          <th class="text-center">著者</th>
          <th class="text-center">削除</th>
        </tr>
      </thead>
      <tbody>
        @foreach($books as $book)
        <tr>
            <td>
            <a href="/book/{{ $book->id }}/edit">{{ $book->id }}</a>
            </td>
            <td>{{ $book->name }}</td>
            <td>{{ $book->price }}</td>
            <td>{{ $book->author }}</td>
            <td>
            <form action="/book/{{ $book->id }}" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
            </form>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div><a href="/book/create" class="btn btn-primary">新規作成</a></div>
  </div>
</div>


<!-- experience -->
<div>
    <div id="drop_zone">Drop a file here</div>
    <div>
    <output id="list"></output>
    <form id="my_form" enctype=multipart/form-data>
        <input type="file" style="display:inline" name="upload_file">
        <br>
        <button type="button" onclick="file_upload()">アップロード</button>
    </form>
    </div>
</div>

@endsection