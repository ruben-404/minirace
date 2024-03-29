<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Corredor;

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
            "DNI" => $request->dni,
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

    public function procesarRegistro(Request $request) {
        $request->validate([
            'dni' => 'required|string|max:255',
            'password' => 'required|string|max:50',
            'direccion' => 'required|string|max:50',
            'nombre' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'fechanacimiento' => 'required|date',
            'numerofederado' => 'nullable|string|max:50',
        ]);
        try{
            $dni = $request->input('dni');

            $existingCorredor = Corredor::where('dni', $dni)->first();

            if ($existingCorredor) {
                return redirect()->back()->withInput()->withErrors(['dni' => 'Ya existe un corredor con este DNI']);
            }
            $nuevoCorredor = new Corredor();
            $nuevoCorredor->DNI = $dni;
            $nuevoCorredor->password = Hash::make($request->password);
            $nuevoCorredor->direccio = $request->input('direccion');
            $nuevoCorredor->nom = $request->input('nombre');
            $nuevoCorredor->cognoms = $request->input('apellidos');
            $nuevoCorredor->dataNaixement = $request->input('fechanacimiento');

            if ($request->filled('numerofederado')) {
                $nuevoCorredor->numeroFederat = $request->input('numerofederado');
                $nuevoCorredor->tipus = 'PRO';
            } else {
                $nuevoCorredor->numeroFederat = null;
                $nuevoCorredor->tipus = 'OPEN';
            }

            $nuevoCorredor->soci = 1;
            $nuevoCorredor->punts = 0;

            // Guardar el nuevo corredor en la base de datos
            $nuevoCorredor->save();

            // Redirigir a la página de lista de aseguradoras u otra página según sea necesario
            return redirect('/home/login')->with('success', 'Socio registrado correctamente.');
        } catch (\Exception $e) {
            // Manejar la excepción y proporcionar una respuesta adecuada
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }


    }
}
