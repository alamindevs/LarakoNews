<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name','slug','status',
    ];
  public function getRouteKeyName()
  {
      return 'slug';
  }

  // reletionship----------------------------------------

    public function posts(){
      return $this->belongsToMany(Post::class,'category_posts')->withTimestamps();
    }


  // Accessor-----------------------------------------------

    public function  getStatusButtonAttribute($value){

      $url = route('admin.category.status',$this->slug);

      if($this->deleted_at!=Null){
        return '<button type="button" class="btn waves-effect waves-light btn-sm btn-danger">Trush</button>';
      }elseif($this->status==0){
        return "<a href=\"{$url}\" class=\"btn waves-effect waves-light btn-sm btn-warning\" onclick=\"return confirm('Are you sure this Category Active ?')\">UnActive</a>";
      }else{
        return "<a href=\"{$url}\" class=\"btn waves-effect waves-light btn-sm btn-success\" onclick=\"return confirm('Are you sure this Category UnActive ?')\">Active</a>";
      }
    }

    public function getTimeFormatAttribute($value){
      return $this->created_at == NULL ? "Not Careate Time" : $this->created_at->format('d F Y');
    }

    // Mutator -------------------------------------------

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

  // scope--------------------------------------------------

    public function scopeStatus($query){
        return $query->where('status',1);
    }



}
