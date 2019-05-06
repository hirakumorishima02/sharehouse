@extends('layouts.townDefault')

@section('content')
            <div class="states row">
                <div class="state col-md-4 col-sm-12">
                    <p>メルボルン</p>
                    <a href="/state/vic/vicTown?id=1"><img src="/img/towns/vic/melbourne.jpg" width=100% height=100%></img></a>
                </div>
                <div class="state col-md-4 col-sm-12">
                    <p>ジーロング</p>
                    <a href="/state/vic/vicTown?id=2"><img src="/img/towns/vic/Geelong.jpg" width=100% height=100%></img></a>
                </div>
                <div class="state col-md-4 col-sm-12">
                    <p>バララット</p>
                    <a href="/state/vic/vicTown?id=3"><img src="/img/towns/vic/ballarat.jpg" width=100% height=100%></img></a>
                </div>
                <div class="state col-md-4 col-sm-12">
                    <p>ベンディゴ</p>
                    <a href="/state/vic/vicTown?id=4"><img src="/img/towns/vic/bendigo.jpg" width=100% height=100%></img></a>
                </div>
            </div>
        </div>
@endsection