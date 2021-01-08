<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    public function tasks()
    {
        // フォルダクラスのインスタンスから紐づくタスククラスのリストを取得
        // 省力せずに書くと$this->hasMany('App\Task', 'folder_id', 'id');
        return $this->hasMany('App\Models\Task');
    }
}
