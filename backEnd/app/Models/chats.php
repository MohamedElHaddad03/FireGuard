<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chats extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_chat';

    protected $fillable = [
        'id_chat',
        'title',
        'content',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function comments()
    {
        return $this->hasMany(comments::class, 'id_chat');
    }
}
