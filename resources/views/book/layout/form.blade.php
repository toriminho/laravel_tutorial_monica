<div class="container ops-main">
    <div class="row">
        <div class="col-md-6">
            <h1>書籍登録</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            @if($target == 'store')
            <form action="/book" method="post">
            @elseif($target == 'update')
            <form action="/book/{{ $book->id }}" method="post">
                <!-- PUTメソッドで送信し、Controllerのupdateメソッドにルーティングする -->
                <input type="hidden" name="_method" value="PUT">
            @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="name">書籍名</label>
                    <input type="text" class="form-control" name="name" value="{{ $book->name }}">
                </div>
                <div class="form-group">
                    <label for="price">価格</label>
                    <input type="text" class="form-control" name="price" value="{{ $book->price }}">
                </div>
                <div class="form-group">
                    <label for="author">著者</label>
                    <input type="text" class="form-control" name="author" value="{{ $book->author }}">
                </div>
                <button type="submit" class="btn btn-default">登録</button>
            </form>
            <a href="/book">戻る</a>
        </div>
    </div>
</div>