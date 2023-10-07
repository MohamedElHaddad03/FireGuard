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
        'id_report',
        'injuries',
        'deaths',
        'state',
    ];

    public function report()
    {
        return $this->belongsTo(reports::class, 'id_report');
    }


}
