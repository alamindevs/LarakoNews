<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Post;
use App\Role;
use App\Gender;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'phone', 'gender', 'role_id', 'address', 'image', 'bio', 'facebook', 'twitter', 'instagram','youtube','slug','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

// Relatinshipe ---------------------------------------

    public function role(){
      return $this->belongsTo(Role::class);
    }

    public function posts(){
      return $this->hasMany(Post::class);
    }

    public function genders(){
      return $this->belongsTo('App\Gender','gender','id');
    }

// Accessor-------------------------------------------

    public function getUserImageAttribute($value){
        if($this->image){
          return asset('uploads/user/'.$this->image);
        }else{
          if($this->gender==1){
            return asset('uploads/user/'.'boy-avatar.png');
          }else{
            return asset('uploads/user/'.'girl-avatar.png');
          }
        }
      }

      public function getStatusButtonAttribute($value){
        $url = route('admin.user.status',$this->slug);
        if($this->deleted_at!=Null){
          return '<button type="button" class="btn waves-effect waves-light btn-sm btn-danger">Trush</button>';
        }elseif($this->status == 0){
          return "<a href=\"{$url}\"  onclick=\"return confirm('Are You Seure This User Active ?')\" class=\"btn waves-effect waves-light btn-sm btn-warning\">UnActive</a>";
        }else{
          return "<a href=\"{$url}\" onclick=\"return confirm('Are You Seure This User UnActive ?')\" class=\"btn waves-effect waves-light btn-sm btn-success\">Active</a>";
        }
      }

// scope-----------------------------------------
    public function scopeStatus($query){
      return $query->where('status',1);
    }


}
