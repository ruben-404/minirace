<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corredor extends Model
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
        'tipus',
        'soci',
        'numeroFederat',
        'punts'
    ];
    

    public function inscritos()
    {
        return $this->hasMany(Inscrito::class, 'DNI', 'DNIcorredor');
    }

}
