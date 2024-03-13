<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;
    protected $table = 'carreres';
    protected $primaryKey = 'idCarrera';
    protected $fillable = [
        'idCarrera',
        'nom',
        'descripció',
        'desnivell',
        'imatgeMapa',
        'maximParticipants',
        'habilitado',
        'km',
        'data',
        'hora',
        'puntSortida',
        'cartellPromoció',
        'preuAsseguradora',
        'preuPatrocini',
        'preuInscripció'
    ];
    public function inscritos()
    {
        return $this->hasMany(Inscrito::class, 'idCarrera');
    }

    public function carreres_assegurades()
    {
        return $this->hasMany(CarreraAssegurada::class, 'idCarrera');
    }

}
