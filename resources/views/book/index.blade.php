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




<!--
=============================================================
 experience
=============================================================
-->

<!-- ファイル入力エリア -->
<div id="upload">
    <div id="drop-area">
        <div id="name">drag & drop</div>
    </div>

    <!-- ファイル選択ボタン -->
    <div class="form-upload">
        <form method="POST" action="/book/upload" enctype="multipart/form-data">
            @csrf
            <input type="file" name="imagefile" id="file-selector" multiple>
            <input type="submit" value="アップロード"></inpub>
        </form>
    </div>

    <img id="image-area">
</div>
<div id="gallery">
    @foreach($images as $image)
        <tr>
            <td>
                <img src="{{asset('storage/' . $image->file_path)}}" width="200">
            </td>
        </tr>
    @endforeach
</div>


<script>
// ファイル選択ボタンのイベントハンドラ
// （ファイルを選択するとchangeイベントが発生する）
const fileSelector = document.getElementById('file-selector');

fileSelector.addEventListener('change', (event) => {
    const fileList = event.target.files;
    console.log(fileList);

    for (const file of fileList) {
        readImage(file);
    }
});


// ファイル入力エリアのイベントハンドラ
const dropArea = document.getElementById('drop-area');

// ドラッグ
dropArea.addEventListener('dragover', (event) => {
  event.stopPropagation();
  event.preventDefault();
  // Style the drag-and-drop as a "copy file" operation.
  event.dataTransfer.dropEffect = 'copy';
});

// ドロップ
dropArea.addEventListener('drop', (event) => {
    event.stopPropagation();
    event.preventDefault();

    const fileList = event.dataTransfer.files;
    getMetadataForFileList(fileList);

    for (const file of fileList) {
        // 画像を表示
        readImage(file);
    }

    const file = fileList[0];
    // データを送る
    let formData = new FormData();
    formData.append("imagefile", file);

    // fetchで非同期にサーバにデータを送る
    fetch('/book/upload',
    {
        method: 'POST',
        cache: 'no-cache',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then((res) => {
        if (!res.ok) {
            throw new Error(`${res.status} ${res.statusText}`);
        }
        return res.blob();
    })
    .then((blob) => {
      // blob にレスポンスデータが入る
    })
    .catch((reason) => {
        console.log(reason);
    });

// ajaxをfetchに変更したためコメントアウト
/*
    // ajax通信（非同期）
    let request = new XMLHttpRequest();

    // サーバから返信を受ける関数
    request.onreadystatechange = function()
    {
        if (request.readyState == 4   // 通信の完了
         && request.status == 200) {  // 通信の成功
            console.log("ajax success");
        }else if(! request.status == 200){
            console.log("ajax fail");
        }
    }

    request.open("POST", "/book/upload");
    request.setRequestHeader('X-CSRF-TOKEN','{{ csrf_token() }}');
    request.send(formData);
    // クライアントの処理が終わらないと
    // サーバから返信があってもコールバック（onreadystatechange）が
    // 動かないことを調べるための無限ループ
    // while(1){}
*/
});


// ファイルの内容を表示する
function getMetadataForFileList(fileList) {
    for (const file of fileList) {
        // Not supported in Safari for iOS.
        const name = file.name ? file.name : 'NOT SUPPORTED';
        // Not supported in Firefox for Android or Opera for Android.
        const type = file.type ? file.type : 'NOT SUPPORTED';
        // Unknown cross-browser support.
        const size = file.size ? file.size : 'NOT SUPPORTED';
        console.log({file, name, type, size});
    }
}

// 読み込んだ画像を表示
function readImage(file) {
    // Check if the file is an image.
    if (file.type && file.type.indexOf('image') === -1) {
        console.log('File is not an image.', file.type, file);
        return;
    }

    const img = document.getElementById('image-area');

    const reader = new FileReader();
    reader.addEventListener('load', (event) => {
        img.src = event.target.result;
    });
    reader.readAsDataURL(file);
}

// ファイルの読み込み状況を表示する
function readFile(file) {
    const reader = new FileReader();
    reader.addEventListener('load', (event) => {
        const result = event.target.result;
        // Do something with result
    });

    reader.addEventListener('progress', (event) => {
        if (event.loaded && event.total) {
            const percent = (event.loaded / event.total) * 100;
            console.log(`Progress: ${Math.round(percent)}`);
        }
    });
    reader.readAsDataURL(file);
}


fileSelector.files;

/*
function file_upload()
{
    // フォームデータを取得
    let formdata = () => new FormData($('#my_form').get(0));
    // ファイルが未登録なら一番最初のファイルを追加
    // 複数ファイルアップロードの場合ここを修正
    if($('input[name="upload_file"]').val() == ""){
      formdata.append('upload_file',files[0])
    }

    //非同期通信
    $.ajax({
        url  : "/upload",
        type : "POST",
        data : formdata,
        cache       : false,
        contentType : false,
        processData : false,
        dataType: 'html',

    })
    .done(function(data, textStatus, jqXHR){
        console.log(data);
    })
    .fail(function(jqXHR, textStatus, errorThrown){
        console.log("fail");
    })
    .always(function(data){
        console.log("complete")
    });
}
*/

</script>

@endsection