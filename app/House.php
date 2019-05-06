<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable =  ['name', 'lat','lng','description'];
    
    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
