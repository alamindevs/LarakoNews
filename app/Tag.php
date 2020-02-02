<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
  use SoftDeletes;

    protected $fillable = [
      'name','slug','status',
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    // relationshipe
      public function posts(){
        return $this->belongsToMany(Post::class,'post_tags')->withTimestamps();
      }

    // Accessor
    public function  getStatusButtonAttribute($value){

      $url = route('admin.category.status',$this->slug);

      if($this->deleted_at!=Null){
        return '<button type="button" class="btn waves-effect waves-light btn-sm btn-danger">Trush</button>';
      }else{
        return '<button type="button" class="btn waves-effect waves-light btn-sm btn-success">Active</button>';
      }
    }

    public function getTimeFormatAttribute($value){
      return $this->created_at == NULL ? "Not Careate Time" : $this->created_at->format('d F Y');
    }

    // Modetor


    // scope
    public function scopeStatus($query){
      return $query->where('status',1);
    }

    // custom function
}
