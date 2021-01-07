<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(int $id)
    {
        $folders = Folder::all();

        // view取得したデータをリターンする
        return view('tasks/index', [
            // テンプレート側ではキー名が変数名となる
            'folders' => $folders,
            'current_folder_id' => $id,
        ]);
    }
}
