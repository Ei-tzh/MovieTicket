<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Township extends Model
{
    protected $fillable=['name'];
    public function cinemas(){
        return $this->hasMany('App\Cinema');
    }
}
