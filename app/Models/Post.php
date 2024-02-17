<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'post_content',
        'post_image',
        'likes',
        'created_at'        
    ];

    public function likes()
    {
        return $this->hasMany(Like::class); //relazione con tabella likes (uno a molti )
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id'); //relazione con tabella comments, il secondo parametro indica la primary key
    }
}
