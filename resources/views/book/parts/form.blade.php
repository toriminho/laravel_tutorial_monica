    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <!--
                error_message.phpをincludeしたが
                ifディレクティブなどが画面に表示されてしまったので
                includeせずにそのまま載せる
            -->
            <div class="row">
                <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                </div>
            </div>

            <!--
            @include('book/parts/error_message')
            -->
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
                <button type="submit" class="btn btn-primary">登録</button>
            </form>
            <a href="/book">戻る</a>
        </div>
    </div>
