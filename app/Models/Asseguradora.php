<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asseguradora extends Model
{
    use HasFactory;
    protected $table = 'asseguradores';
    protected $primaryKey = 'CIF';
    protected $fillable = [
        'CIF',
        'nom',
        'habilitado',
        'adreça',
        'preuCursa',
        'logo'
    ];
    protected $casts = [
        'CIF' => 'string',
    ];
}
