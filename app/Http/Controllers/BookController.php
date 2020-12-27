<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Requests\BookRequest;

class BookController extends Controller
{
    public function index()
    {
        // DBよりBookテーブルの値を全て取得
        $books = Book::all();
        // 取得した値をビューに渡す
        return view('book/index', compact('books'));
    }

    public function edit($id)
    {
        // DBよりURIパラメータと同じIDを持つBookの情報を取得
        $book = Book::findOrFail($id);
        // 取得した値をビュー「book/edit」に渡す
        return view('book/edit', compact('book'));
    }

    // 以下の編集画面の登録ボタンのコールバック
    // http://localhost:8000/book/1/edit
    // $requestは、リクエスト関連のデータが入っている
    // $idは、アドレスに指定された書籍のID
    public function update(BookRequest $request, $id)
    {
        // Bookテーブルから該当IDの要素を取得する
        $book = Book::findOrFail($id);
        // 編集画面からPUTで送られた書籍名、価格、著者をBookテーブルに格納する
        $book->name = $request->name;
        $book->price = $request->price;
        $book->author = $request->author;
        $book->save();

        return redirect("/book");
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect("/book");
    }

    // トップページの「新規作成」ボタンのコールバック
    // viewのcreate.blade.phpでページを生成
    // create.blade.phpの「登録」ボタンを押下すると
    // store()が呼ばれる
    public function create()
    {
        // 空の$bookを渡す
        $book = new Book();
        return view('book/create', compact('book'));
    }

    // create.blade.phpの「登録」ボタンのコールバック
    // ページは生成せず、DB操作だけを行う
    // トップページへ遷移する
    public function store(BookRequest $request)
    {
        $book = new Book();
        $book->name = $request->name;
        $book->price = $request->price;
        $book->author = $request->author;
        $book->save();

        return redirect("/book");
    }
}
