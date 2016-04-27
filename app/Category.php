<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $appends = ['numberOfPosts'];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function getNumberOfPostsAttribute()
    {
        return $this->topics->count();
    }
}
