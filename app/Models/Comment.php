<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'author', 'post_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
