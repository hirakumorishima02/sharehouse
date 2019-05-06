@extends('layouts.default')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">お問い合わせ</div>
                <div class="panel-body">
                    <p>誤りがないことを確認の上、送信ボタンを押してください。</p>
                </div>
                
                <table class="table">
                    <tr>
                        <th>お名前</th>
                        <td>{{ $contact->name }}</td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td>{{ $contact->email }}</td>
                    </tr>
                    <tr>
                        <th>お問い合わせ内容</th>
                        <td>{{ $contact->body }}</td>
                    </tr>
                </table>
                
                {!! Form::open(['url' => 'contact/complete',
                                'class' => 'form-horizontal',
                                'id' => 'post-input'
                ]) !!}
                
                @foreach($contact->getAttributes() as $key => $value)
                    @if(isset($value))
                        @if(is_array($value))
                            @foreach($value as $subValue)
                                <input name="{{ $key }}[]" type="hidden" value="{{ $subValue }}">
                            @endforeach
                        @else
                            {!! Form::hidden($key, $value) !!}
                        @endif
                    @endif
                @endforeach
                
                {!! Form::submit('戻る', ['name' => 'action', 'class' => 'btn']) !!}
                {!! Form::submit('送信', ['name' => 'action', 'class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection