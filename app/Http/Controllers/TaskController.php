<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(int $id)
    {
        // 全てのフォルダを取得
        $folders = Folder::all();

        // 選ばれたフォルダを取得する find()プライマリキーのカラムを条件に1行分のデータを取得する
        $current_folder = Folder::find($id);

        // 選ばれたフォルダに紐づくタスクを取得する　Tasks::where('folder_id', '=', $current_folder->id)->get();
        $tasks = $current_folder->tasks()->get();

        // view取得したデータをリターンする
        return view('tasks/index', [
            // テンプレート側ではキー名が変数名となる
            'folders' => $folders,
            'current_folder_id' => $current_folder->id,
            'tasks' => $tasks,
        ]);
    }
}
