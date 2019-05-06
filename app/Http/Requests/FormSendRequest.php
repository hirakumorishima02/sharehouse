<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormSendRequest extends FormRequest
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
            'name' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'suburb' => 'required',
            'description' => 'required|between:20,500',
            'photo' =>  'required|file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
        
    public function messages() {
        
        return[
            'name.required' => '名前は必須です。',
            'lat.required' => 'シェアハウスの位置を選択してください。',
            'suburb.required' => '地域は必須です。',
            'description.required' => 'シェアハウスの説明は20字以上、500字以下で記入可能です。',
            'description.between' => 'シェアハウスの説明は20字以上、500字以下で記入可能です。',
            'photo.required' => '画像は必須です。',
            'photo.mimes' => 'jpg、png、bmp、gif、svg形式でアップロードしてください。',
            'photo.max' => '画像ファイルが大きすぎます。',
            ];
    }
}
