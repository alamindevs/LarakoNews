<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogoBreadcrumb extends Model
{
  protected $fillable =[
    'log','breadcrumb','status',
  ];
    public function getLogoAttribute($value){
      return asset('uploads/logo/'.$this->log);
    }

    public function getBreadcrumbsAttribute($value){
      return asset('uploads/logo/'.$this->breadcrumb);
    }
}
