<?php

namespace App\Models;

class Reply extends Model
{
    const TYPE_TOPIC = 0; // 帖子s
    const TYPE_REPLY = 1; // 评论

    protected $fillable = ['content'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
