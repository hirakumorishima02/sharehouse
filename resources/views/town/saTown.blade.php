@extends('layouts.default')

@section('content')
    <div class="row mapview">
    <!--マップ表示-->
    <div class="col-lg-8 col-sm-12 map" >
    <h3>気になるシェアハウスをチェックする</h3>
    <div id="map" style="width:100%; height:90%;"></div>
    </div>
    
    <!-- Map入力フォーム -->
    <form method="POST" action="/map" class="col-lg-4 col-sm-12 sharehouse-form" enctype="multipart/form-data"> 
    {{csrf_field()}}
    <h3>シェアハウスを登録する</h3>
    <div class="error">
    @if ($errors->has('name'))
        @foreach($errors->get('name') as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif
    </div> 
    シェアハウスの名前 
    <br>
    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
    <br>
    <div class="error">
    @if ($errors->has('suburb'))
        @foreach($errors->get('suburb') as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif
    </div> 
    地域名
    <br>
    <input type="text" name="suburb" class="form-control" value="{{ old('suburb') }}">
    <br>
    <div class="error">
    @if ($errors->has('description'))
        @foreach($errors->get('description') as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif
    </div> 
    シェアハウスに関する情報（20字から500字まで）
    <br>
    <textarea type="text" name="description" class="form-control" onKeyUp="countLength(value, 'textlength');">{{ old('description') }}</textarea> 
    <p id="textlength">0</p>
    <div class="error">
    @if ($errors->has('photo'))
        @foreach($errors->get('photo') as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif
    </div> 
    シェアハウスの画像
    <br>
    <input type="file" name="photo">
    <br>
    <div class="error">
    @if ($errors->has('lat'))
        @foreach($errors->get('lat') as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif
    </div> 
    緯度
    <br>
    <input type="text" name="lat" id="show_lat" placeholder="自動入力" class="form-control" value="{{ old('lat') }}" readonly>
    <br>
    経度
    <br>
    <input type="text" name="lng" id="show_lng" placeholder="自動入力" class="form-control" value="{{ old('lng') }}" readonly>
    <br>
    <button type="submit" class="btn btn-primary">登録</button>
    </form> 
    </div>
    
    
    <!-- 一覧表示 -->
    <table class="table table-hover table-bordered text-center">
    <thead class="thead-dark">
    <tr>
    <th>名称</th>
    <th>地域</th>
    <th>登録日</th>
    <th>削除</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $val)
    <tr class="table-info">
        <td><a href="/house/{{$val->id}}">{{$val->name}}</a></td>
        <td>{{$val->suburb}}</td>
        <td>{{$val->created_at}}</td>
        <th><a href="#" data-id="{{ $val->id }}" class="del">削除</a></th>
        <form method="post" action="{{ url('/houses', $val->id ) }}" id="form_{{ $val->id }}">
        {{ csrf_field() }}
        {{ method_field('delete') }}
        </form>
    </tr>
    @endforeach
    </tbody>
    </table>
    
    <!--mapsテーブルのデータを取得-->
    <?php $list = \App\House::all()->toArray();
    // phpの配列をJavaScriptに渡すためにjsonファイルに変換する
    $json_list = json_encode($list);
    // ddメソッドで配列獲得ができているか確認
    // dd($list);  
    ?>
    
 
    <script type="text/javascript"> 
    
    var map;
    var marker = [];
    var infoWindow = [];
    var markersArray = [];
    var list = <?php echo $json_list ?>;

    var params = (new URL(document.location)).searchParams;
    var id = parseInt(params.get("id"));
    


    function initMap() {
        // mapLatLngで地図の作成
        
        // #mapに地図を埋め込む
        
        if(id == 1) {
            center = {lat: -33.848463912396205, lng: 151.15784284135657};
        } else if (id == 2){
            center = {lat: -32.976663, lng: 151.6897003};
        } else if (id == 3){
            center = {lat: -33.3146575, lng: 151.3111836};
        } else if (id == 4){
            center = {lat: -34.4282526, lng: 150.8930585};
        } else {
            center = {lat: -28.2536611, lng: 153.524888};
        }
        
        map = new google.maps.Map(document.getElementById('map'), {
            center: center,
            zoom: 10
        });
        console.log(center); //consoleで{lat: -33.848463912396205, lng: 151.15784284135657}が表示される
        console.log(id); //idの値が「1」と表示される
        
        // forでlistのデータを取得
        for (var i = 0; i < list.length; i++) {
            // 緯度と傾度のデータ作成
            markerLatLng = {lat: parseFloat(list[i]['lat']), lng: parseFloat(list[i]['lng'])}; 
            // マーカーの追加
            marker[i] = new google.maps.Marker({
            position: markerLatLng,
            map: map,
            icon: "/img/icon/circle64.png",
            });

        
        // 吹き出しの追加
        infoWindow[i] = new google.maps.InfoWindow({
            content: '<div class="map">' +
             list[i]['name'] +
             '<br>' +
             '<img src="/storage/photo_images/'+list[i]['name'] +
             '.jpg" width="100px" height="100px">'+
             '<br>' +
             '<p class="textOverflowTest">'+
             nl2br(list[i]['description']) +
             '</p>'+
             '<br>' +
             '<a href="/house/'+
             list[i]['id']+
             '">'+
             list[i]['name']+
             'の詳細を見る</a>'+
             '</div>'
        });
        
        // マーカーにinfoWindowがポップアップするクリックイベントを追加
        markerEvent(i);
        }
        
        // マーカー設置をするクリックイベントを追加
        markerSet();
        
        // マーカーを中心点にして地図を移動する
        // google.maps.e.addListener(map, "idele", function(){
        //     mylistener(map.getCenter());
        // });
    }
    
    // マーカーをクリックした時に吹き出しを表示されるfunctionを設定
    function markerEvent(i) {
        marker[i].addListener('click', function() {
            infoWindow[i].open(map, marker[i]);
        });
    }
    
    // mapをクリックした時のイベントを設定（マーカー設置）
    function markerSet() {
        google.maps.event.addListener(map, 'click', mylistener);
    }
    
    // クリックした時にマーカーが設置されるfunctionを設定
    function mylistener(e) {
        // clearOverlaysで設置したマーカーを最新のもの以外全て削除
        clearOverlays();
        // marker作成
        var marker = new google.maps.Marker({
            position:e.latLng,
            map:map
        });
        markersArray.push(marker);
        document.getElementById("show_lat").value = e.latLng.lat();
        document.getElementById("show_lng").value = e.latLng.lng();
    }
    
    // 設置したマーカーを最新のもの以外全て削除
    function clearOverlays() {
        for(var i = 0; i < markersArray.length; i++ ) {
            markersArray[i].setMap(null);
        }
    }
    
    // 改行して表示するファンクションの設定
    function nl2br(str) {
        var res = str.replace(/\r\n/g, "<br>");
        res = res.replace(/(\n|\r)/g, "<br>");
        return res;
    }
    </script>
    
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvn9d-e_XunRhPixNrbCx5Bz4wt28sCKE&callback=initMap"></script>

@endsection