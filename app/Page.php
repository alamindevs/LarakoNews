<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable =[
      'name','page_tag','description','slug','status',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
