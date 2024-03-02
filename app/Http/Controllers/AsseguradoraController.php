<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asseguradora;

class AsseguradoraController extends Controller
{
    public function getAsseguradoras()
    {
        $asseguradoras = Asseguradora::all();
        return view('admin.asseguradores.tablaAsseguradores', compact('asseguradoras'));
    }
    public function addAseguradora()
    {
        return view('admin.asseguradores.formularios.addAsseguradores');
    }

    public function guardar(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'cif' => 'required|string|max:255',
            'nombre' => 'required|string',
            'direccion' => 'required|string',
            'precio' => 'required|numeric',
            'habilitado' => 'required|boolean',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagen = $request->file('logo');
        $nombreCIF = $request->cif;
        $extension = $imagen->getClientOriginalExtension();
        $nombreArchivo = $nombreCIF . '.' . $extension;
    
        // Guardar la imagen en la carpeta 'public'
        $imagen->move(public_path('storage/asseguradoresImages'), $nombreArchivo);


        // Crear una nueva instancia de Asseguradora y asignar los valores
        $aseguradora = new Asseguradora();
        $aseguradora->cif = $request->cif;
        $aseguradora->nom = $request->nombre;
        $aseguradora->adreça = $request->direccion;
        $aseguradora->preuCursa = $request->precio;
        $aseguradora->logo = $nombreArchivo;
        $aseguradora->habilitado = $request->habilitado;

        // Guardar la aseguradora en la base de datos
        $aseguradora->save();

        // Redirigir a la página de lista de aseguradoras u otra página según sea necesario
        return redirect('/admin/asseguradoras');
    }
    public function editar($cif)
    {
        // Obtener la asseguradora por su CIF
        $asseguradora = Asseguradora::findOrFail($cif);

        // Devolver la vista de edición con los datos de la asseguradora
        return view('admin.asseguradores.formularios.editarAsseguradores', compact('asseguradora'));
    }
    public function actualizar(Request $request, $cif)
    {
        $asseguradora = Asseguradora::findOrFail($cif);
        
        $imagen = $request->file('logo');
        $extension = $imagen->getClientOriginalExtension();
        $nombreArchivo = $cif . '.' . $extension;

        $imagen->move(public_path('storage/asseguradoresImages'), $nombreArchivo);

        $asseguradora->update([
            'nom' => $request->input('nom'),
            'adreça' => $request->input('direccion'),
            'preuCursa' => $request->input('precio'),
            'habilitado' => $request->input('habilitado'),
            'logo' => $nombreArchivo
        ]);

        return redirect('/admin/asseguradoras');
    }
}
