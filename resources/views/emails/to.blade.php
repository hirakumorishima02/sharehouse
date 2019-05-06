@extends('layouts.default')

@section('content')
お名前：{{ $content['from_name'] }}
メールアドレス：{{ $content['from'] }}
お問い合わせ内容
{{ $content['body'] }}
@endsection