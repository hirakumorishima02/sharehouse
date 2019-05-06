<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\House;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Request $request, House $house) {
        $this->validate($request, [
            'body' => 'required'
            ]);
        $comment = new Comment(['body' => $request->body]);
        $house->comments()->save($comment);
        return redirect()->action('TownController@getHouse', compact('house'));
    }
    
    public function destroy(House $house, Comment $comment) {
        $comment->delete();
        return redirect()->back();
    }
}

