<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;
    
    // メンバ変数の宣言
    protected $content;
    protected $viewStr;
    
    // メールの処理が発動した際に、引数をとって、メンバ変数に格納する
    public function __construct($content, $viewStr = 'to')
    {
        $this->content = $content;
        $this->viewStr = $viewStr;
    }
    
    // メイン処理
    // text()メソッドで平文メールのビューをセット
    // subject()メソッドでメールのタイトルをセット
    // with()メソッドでビューに渡す変数をセット
    // from()メソッドでビューに渡す送り主のメールアドレスをセット
    public function build()
    {
        return $this->text('emails.'.$this->viewStr)
            ->to($this->content['to'], $this->content['to_name'])
            ->from($this->content['from'], $this->content['from_name'])
            ->subject($this->content['subject'])
            ->with([
                'content' => $this->content,
            ]);
    }
}