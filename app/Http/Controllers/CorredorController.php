<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CorredorController extends Controller
{
    public function paginaCarreras()
    {
        return view('principal.paginas.paginaCarreras');
    }
}
