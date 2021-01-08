<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFolder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // キー部分がInput要素のname属性, 未入力、20文字以上の場合エラーメッセージ
            'title' => 'required|max:20',
        ];
    }

    public function attributes()
    {
        return [
            // 英語表記を日本語に変更する
            'title' => 'フォルダ名',
        ];
    }
}
