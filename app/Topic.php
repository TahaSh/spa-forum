<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $guarded = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $visible = ['id', 'title', 'body', 'views', 'time', 'breadcrumbs', 'category_id', 'user', 'comments'];
    protected $appends = ['time', 'breadcrumbs', 'user', 'comments'];
    protected $casts = [
        'views' => 'integer',
        'user_id' => 'integer'
    ];

    public function getTimeAttribute()
    {
        return $this->created_at->timestamp;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getUserAttribute()
    {
        $user = $this->user()->first();

        return [
            'id'   => $user->id,
            'name' => $user->name
        ];
    }

    public function getBreadcrumbsAttribute()
    {
        $category = $this->category;

        return [
            [ 'name' => 'Home', 'link' => '/' ],
            [ 'name' => $category->name, 'link' => "/category/$category->id"],
            [ 'name' => $this->title, 'link' => "/topic/$this->id"]
        ];
    }

    public function getCommentsAttribute()
    {
        return $this->comments()->get();
    }
}
