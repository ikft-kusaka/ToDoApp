<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFolder;
use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    // Request(Post, Get)$requestでユーザーの入力値を取得(テンプレートのname属性), RequestはFormRequestと互換性がある
    public function create(CreateFolder $request)
    {
        // フォルダモデルのインスタンスを作成する
        $folder = new Folder();

        // タイトルに入力値を代入する, Request name="title"を取得
        $folder->title = $request->title;

        // インスタンスの状態をデータベースに書き込む
        $folder->save();

        // 元の画面にリダイレクト
        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}
