<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Corredor extends Authenticatable
{
    use HasFactory;
    protected $table = 'corredors';
    protected $primaryKey = 'DNI';
    protected $fillable = [
        'DNI',
        'nom',
        'cognoms',
        'password',
        'direccio',
        'dataNaixement',
        'genere',
        'tipus',
        'soci',
        'numeroFederat',
        'punts'
    ];
    protected $casts = [
        'DNI' => 'string',
    ];

    public function inscritos()
    {
        return $this->hasMany(Inscrito::class, 'DNI', 'DNIcorredor');
    }

}
