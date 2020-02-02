<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
  protected $primaryKey = 'id';

    public function user(){
      return $this->hasOne('App\User','id','gender');
    }
}
