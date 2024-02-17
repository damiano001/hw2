<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'post_id',
        'username'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class); //relazione con tabella posts
    }
}
