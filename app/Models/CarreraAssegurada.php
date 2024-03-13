<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarreraAssegurada extends Model
{
    use HasFactory;
    protected $table = 'carreres_assegurades';
    protected $fillable = [
        'idCarrera',
        'CIFasseguradora'
    ];
    public function asseguradora()
    {
        return $this->belongsTo(Asseguradora::class, 'CIFasseguradora', 'CIF');
    }
    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'idCarrera');
    }
}
