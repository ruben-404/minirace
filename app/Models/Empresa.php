<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $table = 'empresas';
    protected $primaryKey = 'CIF';
    protected $fillable = [
        'CIF',
        'nom',
        'email',
        'preuPlanaPrincipal',
        'preuSociAnual'
    ];
    protected $casts = [
        'CIF' => 'string',
    ];
}
