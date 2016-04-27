<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body', 'user_id', 'topic_id'];
    protected $visible = ['body', 'user', 'time'];
    protected $appends = ['user', 'time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function getUserAttribute()
    {
        $user = $this->user()->first();

        return [
            'id'   => $user->id,
            'name' => $user->name
        ];
    }

    public function getTimeAttribute()
    {
        return $this->created_at->timestamp;
    }
}
