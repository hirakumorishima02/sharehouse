@extends('layouts.default')

@section('content')
            <h3>{{ $house->name }}</h3>
            <div class="status">
                <p>{!!  nl2br($house->description) !!}</p>
            </div>
            <!--<div class="photo">-->
            <!--    <h3>{{  $house->name }}の写真</h3>-->
            <!--</div>-->
            <div class="comments">
                <h3>{{ $house->name }}に対するコメント</h3>
                <ul>
                    @forelse ($house->comments as $comment)
                    <li>{{ $comment->body }}
                    <a href="{{ action('CommentsController@destroy', [$house,$comment]) }}">[コメント削除]</a></li>
                    @empty
                    コメントはまだありません
                    @endforelse
                </ul>
            </div>
        <form action="{{ action('CommentsController@store', $house) }}" method="post" >
        {{ csrf_field() }}
        <p>
        <input type="text" name="body" placeholder="enter Comments" value="{{ old('body') }}">
        </p>
        <p>
        <input type="submit" value="Add Comments">
        </p>
        </form>
            </div>
            <h2>オーナーに問い合わせる</h2>
            <!--エラーの表示-->
            @if ($errors->any())
                <div class="alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            </form>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            {!! Form::open(['url' => 'contact/confirm','class' => 'form-horizontal']) !!}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', 'お名前：', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name',null,['class'=>'col-sm-2 control-label']) !!}
                    
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="form-group{{ $errors->has('email') ? ' has-error ' : '' }}">
                {!! Form::label('email', 'メールアドレス:',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::email('email',null, ['class'=>'form-cotrol']) !!}
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="form-group{{ $errors->has('body') ? ' has-error ' : '' }}">
                {!! Form::label('email','お問い合わせ内容:',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::textarea('body',null, ['class'=>'form-control']) !!}
                    @if ($errors->has('body'))
                        <span class="help-block">
                            <strong>{{ $errors->first('body') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    {!! Form::submit('確認',['class'=>'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}
@endsection