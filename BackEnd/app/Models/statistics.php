<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statistics extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_statistic';


    protected $fillable = [
        'id_statistic',
        'date_debut',
        'date_fin',
        'id_localisation',
        'injuries',
        'deaths',
        'state',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'id_location');
    }

}
