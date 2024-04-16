<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarreraPatrocinada extends Model
{
    use HasFactory;
    protected $table = 'curse_sponsors';
    protected $fillable = [
        'cifSponsor',
        'idCarrera'
    ];
    public function sponsor()
    {
        return $this->belongsTo(Sponsor::class, 'cifSponsor', 'CIF'); /* !!!! */
    }
    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'idCarrera');
    }
}
