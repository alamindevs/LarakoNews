<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertizement extends Model
{
    protected $fillable = ['name','type','url','add','status'];

    // Accessor---------------------------------------------

    public function getImageUrlAttribute($value){
      if($this->type==1){
          return asset('uploads/advertizement/'.$this->add);
      }
      
    }

    public function getAddTypeAttribute($value){
      if($this->type==1){
        return 'Custom Advertizement';
      }
      if($this->type==2){
        return 'Google Adsense';
      }

    }








}
