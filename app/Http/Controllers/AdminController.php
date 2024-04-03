<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login() {
        return view('admin.loginAdmin');
    }
    public function ProcesarLogin(Request $request) {
        $credentials = [
            "email" => $request->email,
            "password" => $request->password
        ];
        $admins = Admin::all();
        // Crear usuario admin si es necesario:

        //    $admin = new Admin();
        //    $admin->email = $request->email;
        //    $admin->password = Hash::make($request->password);

        //    $admin->save(); 
        
        if (Auth::guard('admin')->attempt($credentials)) {

            $request->session()->put('email', $credentials['email']);
            $request->session()->put('rol', 'admin');

            return redirect('/admin/carreras');

        } else {

            return redirect('/admin');

        }
        
        //Mostrar info:
        
        /*var_dump($request->all());
        $admins = Admin::all();
        // Imprimir los datos de los registros obtenidos
        foreach ($admins as $admin) {
            var_dump($admin->toArray());
        }*/
    }
    public function logOut(Request $request) {
        
        $request->session()->flush();

        return redirect('/admin');
    }
}
