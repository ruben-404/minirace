<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CorredorController extends Controller
{
    public function paginaCarreras()
    {
        return view('principal.paginas.paginaCarreras');
    }

    // SECCIÓN LOGIN

    public function paginaLogin()
    {
        return view('principal.formularios.login');
    }

    public function logOut(Request $request) {
        
        $request->session()->flush();

        return redirect('/home/login');
    }

    public function ProcesarLogin(Request $request) {
        $credentials = [
            "DNI" => $request->email,
            "password" => $request->password
        ];

        
        if (Auth::guard('web')->attempt($credentials)) {

            $request->session()->put('DNI', $credentials['DNI']);

            return redirect('/');

        } else {

            return redirect('/home/login');

        }

    }

    // SECCION REGISTER
    public function paginaRegister()
    {
        return view('principal.formularios.register');
    }
}
