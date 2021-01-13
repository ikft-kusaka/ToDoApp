<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
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

    public function showCreateForm(int $id)
    {
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }

    // folderテーブルに新規フォルダを登録
    public function create(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $current_folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }

    public function showEditForm(int $id, int $task_id)
    {
        // tasksテーブルのIDがtask_idと一致するものを取得
        $task = Task::find($task_id);
        
        return view('tasks/edit', [
            'task' => $task,
            ]);
        }
        
        public function edit(int $id, int $task_id, EditTask $request)
        {
        // tasksテーブルのIDがtask_idと一致するものを取得
        $task = Task::find($task_id);

        // 各列に$requestの値を挿入
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        // トップページに戻る
        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }
}
