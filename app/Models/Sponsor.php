<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;
    protected $table = 'sponsors';
    protected $primaryKey = 'CIF';
    protected $fillable = [
        'CIF',
        'nom',
        'logo',
        'adreça',
        'destacat'
    ];

}
