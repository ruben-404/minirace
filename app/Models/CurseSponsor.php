<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurseSponsor extends Model
{
    use HasFactory;
    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('cifSponsor', '=', $this->getAttribute('cifSponsor'))
            ->where('idCarrera', '=', $this->getAttribute('idCarrera'));
        return $query;
    }
    protected $table = 'curse_sponsors';
    protected $fillable = [
        'cifSponsor',
        'idCarrera'
    ];

}
