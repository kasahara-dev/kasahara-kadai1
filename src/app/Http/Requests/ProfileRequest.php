<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'gender' => 'required',
            'birthday' => ['required', 'date'],
        ];
    }
    public function messages()
    {
        return [
            'gender.required' => '性別を選択してください',
            'birthday.required' => '誕生日を入力してください',
            'birthday.date' => '誕生日は日付を入力してください',
        ];
    }
}
