<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_comment';

    protected $fillable = [
        'id_comment',
        'content',
        'id_user',
        'id_chat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function chats()
    {
        return $this->belongsTo(chats::class, 'id_chat');
    }
}
