<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\House;
use App\Http\Requests\FormSendRequest;


class TownController extends Controller
{
    public function nswTown() {
        $list = House::latest()->get();
        return view('town.nswTown', compact('list'));
    }
    public function vicTown() {
        $list = House::latest()->get();
        return view('town.vicTown', compact('list'));
    }
    public function qldTown() {
        $list = House::latest()->get();
        return view('town.qldTown', compact('list'));
    }
    public function saTown() {
        $list = House::latest()->get();
        return view('town.saTown', compact('list'));
    }
    public function waTown() {
        $list = House::latest()->get();
        return view('town.waTown', compact('list'));
    }
    public function tasTown() {
        $list = House::latest()->get();
        return view('town.tasTown', compact('list'));
    }
    
    // DI（注入）
    public function postHouse(FormSendRequest $request)
    {
        // POSTで受信したMapデータの登録
        $map = new House(); 
        $map->name = $request->name;
        $map->lat = $request->lat;
        $map->lng = $request->lng;
        $map->description = $request->description;
        $map->suburb = $request->suburb;
        $map->photo =  $request->photo->storeAs('public/photo_images', $map->name . '.jpg');
        $map->save();
        // Mapデータ取得（最新画面を表示->indexメソッドを呼びさせる redilect）
        $list = House::all();
        // return view('town.nswTown', ['list' => $list]);
        return redirect()->back();
    }
    
    public function getHouse($id)
    {
        // 指定のMapデータ取得
        $house = House::find($id);
        return view('house', compact('house'));
    }
    
    public function destroy(House $house) {
        $house->delete();
        return redirect()->back();
    }
}
