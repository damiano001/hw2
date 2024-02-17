<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'post_id',
        'username',
        'comment_content'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id'); //relazione con tabella posts
    }
}
