<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Contact;

class ContactsController extends Controller
{
    public function confirm(ContactRequest $request)
    {
        $contact = new Contact($request->all());
        return view('confirm', compact('contact'));
    }
    
    public function complete(ContactRequest $request)
    {
        // exceptメソッドは、引数以外の入力データを取得できる
        $input = $request->except('action');
        
        if ($request->action === '戻る') {
            return redirect()->action('TownController@getHouse')->withInput($input);
        }
        // createメソッドは引数のものを全てDBにinsertできるメソッド
        Contact::create($request->all());
        // 二重送信防止
        $request->session()->regenerateToken();
        
        return view('complete');
        
        // 送信メール
        \Mail::send(new Contact([
            'to' => $request->email,
            'to_name' => $request->name,
            'from' => 'ujinchu@gmail.com',
            'from_name' => 'MySite',
            'subject' => 'お問い合わせありがとうございました。',
            'body' => $request->body
        ]));
 
        // 受信メール
        \Mail::send(new Contact([
            'to' => 'ujinchu@gmail.com',
            'to_name' => 'MySite',
            'from' => $request->email,
            'from_name' => $request->name,
            'subject' => 'サイトからのお問い合わせ',
            'body' => $request->body
        ], 'from'));
        }
}
