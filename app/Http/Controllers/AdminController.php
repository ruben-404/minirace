<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login() {
        return view('admin.loginAdmin');
    }
    public function ProcesarLogin(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Si las credenciales son correctas, redirigir al usuario a su área privada
            return app()->make(CarreraController::class)->getCarreras();
        }

        // Si las credenciales no son válidas, redirigir de vuelta al formulario de inicio de sesión con un mensaje de error
        return redirect()->back()->withErrors(['email' => 'Email o contraseña incorrectos']);
        
        
        /*var_dump($request->all());
        $admins = Admin::all();
        // Imprimir los datos de los registros obtenidos
        foreach ($admins as $admin) {
            var_dump($admin->toArray());
        }*/
    }
}
