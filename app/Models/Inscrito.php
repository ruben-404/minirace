<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscrito extends Model
{
    use HasFactory;
    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('DNIcorredor', '=', $this->getAttribute('DNIcorredor'))
            ->where('idCarrera', '=', $this->getAttribute('idCarrera'));
        return $query;
    }
    protected $table = 'inscritos';
    protected $fillable = [
        'DNIcorredor',
        'idCarrera',
        'CIFasseguradora',
        'numDorsal',
        'qr',
        'dataArribada',
        'temps'
    ];
    public function corredor()
    {
        return $this->belongsTo(Corredor::class, 'DNIcorredor', 'DNI');
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'idCarrera');
    }

}
