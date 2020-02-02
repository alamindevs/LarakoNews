<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

use CyrildeWit\EloquentViewable\Viewable;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;

class Post extends Model implements ViewableContract
{
  use SoftDeletes;
  use Viewable;


  protected $fillable = [
      'title','image','description','short_description','slug','status','published_at','created_at','updated_at','deleted_at','usertrash',
  ];

  protected $dates = [
    'published_at',
    // your other new column
];
public function getRouteKeyName()
{
    return 'slug';
}

  // reletionship----------------------------------------

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function categorys(){
      return $this->belongsToMany(Category::class,'category_posts')->withTimestamps();
    }

    public function tags(){
      return $this->belongsToMany(Tag::class,'post_tags')->withTimestamps();
    }

    public function comments(){
      return $this->hasMany(Comment::class);
    }




  // Accessor---------------------------------------------


  public function getImageUrlAttribute($value){
    $location = 'uploads/post/'.$this->image;
    if(!file_exists($location) ){
      return asset('uploads/post/'.'placeholder-image.png');
    }elseif($this->image!=Null){
      return asset('uploads/post/'.$this->image);
    }else {
      return asset('uploads/post/'.'placeholder-image.png');
    }
  }

  public function getImageSliderAttribute($value){
    $location = 'uploads/post/slider/'.$this->image;
    if(!file_exists($location)){
      return asset('uploads/post/slider/'.'placeholder-image.png');
    }elseif($this->image!=Null){
      return asset('uploads/post/slider/'.$this->image);
    }else {
      return asset('uploads/post/slider/'.'placeholder-image.png');
    }
  }

  public function getImageSmallAttribute($value){
    $location = 'uploads/post/small/'.$this->image;
    if(!file_exists($location) ){
      return asset('uploads/post/small/'.'placeholder-image.png');
    }elseif($this->image!=Null){
      return asset('uploads/post/small/'.$this->image);
    }else {
      return asset('uploads/post/small/'.'placeholder-image.png');
    }
  }

  public function getPublishTimeAttribute($value){
    return $this->published_at==NULL ? 'No Publish' : $this->published_at->format('d F Y');
  }

  //Mutator----------------------------------------------

    public function setPublishedAtAttribute($value){

      $this->attributes['published_at'] = $value ? : NULL;

    }

  // scope--------------------------------------------------

  public function scopePublish($query){
    return $query->where('published_at','<=',Carbon::now());
  }
  public function scopeSchedule($query){
    return $query->where('published_at','>',Carbon::now());
  }
  public function scopeStatus($query){
    return $query->where('status',1);
  }
  public function scopePanding($query){
    return $query->where('status',2);
  }
  public function scopeLatestFirst($query){
    return $query->orderBy('id','desc');
  }
  public function scopeTrash($query){
    return $query->onlyTrashed();
  }



  // normal function-------------------------------------------

  public function dateFormet($time = false){
    $formet='d/m/Y';
    if($time) $formet = $formet.' H:i:s';
    return $this->created_at->format($formet);
  }

  public function statusButton(){
    if($this->deleted_at!=NULL){
      return '<button type="button" class="btn waves-effect waves-light btn-sm btn-danger">Trush</button>';
    }elseif(!$this->published_at){
      return '<button type="button" class="btn waves-effect waves-light btn-sm btn-secondary">Not Publish</button>';
    }elseif ($this->published_at && $this->published_at->isfuture()) {
      return '<button type="button" class="btn waves-effect waves-light btn-sm btn-info">Schedule</button>';
    }elseif(!$this->published_at->isfuture() && $this->status==2){
      return '<button type="button" class="btn waves-effect waves-light btn-sm btn-primary">Pending</button>';
    }elseif ($this->status==0) {
      return '<button type="button" class="btn waves-effect waves-light btn-sm btn-danger">Reject</button>';
    }else{
      return '<button type="button" class="btn waves-effect waves-light btn-sm btn-success">Publish</button>';
    }
  }




}
