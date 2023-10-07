<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reports extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_report';


    protected $fillable = [
        'id_report',
        'id_user',
        'id_location',
        'send_rescue',
        'proof',
        'confirmation',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'id_location');
    }

    public function statistics()
    {
        return $this->hasMany(statistics::class, 'id_report');
    }

}
