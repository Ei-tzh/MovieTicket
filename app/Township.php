<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Township extends Model
{
    public function cinemas(){
        return $this->hasMany('App\Cinema');
    }
}
