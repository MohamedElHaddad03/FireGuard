<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_location';

    protected $fillable = [
        'id_location',
        'longitude',
        'attitude',
    ];

    public function reports()
    {
        return $this->hasMany(location::class, 'id_location');
    }

    public function statistics()
    {
        return $this->hasMany(statistics::class, 'id_statistic');
    }
}
