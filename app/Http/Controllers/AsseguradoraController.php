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
    public function toggleHabilitado(Request $request, $cif)
    {
        $asseguradora = Asseguradora::findOrFail($cif);
        $asseguradora->habilitado = !$asseguradora->habilitado;
        $asseguradora->save();

        return redirect('/admin/asseguradoras');

    }

    public function guardar(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'cif' => 'required|string|max:255',
            'nombre' => 'required|string|max:50',
            'direccion' => 'required|string|max:50',
            'precio' => 'required|numeric|digits_between:1,4',
            'habilitado' => 'required|boolean',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagen = $request->file('logo');
        $nombreCIF = $request->cif;
        $extension = $imagen->getClientOriginalExtension();
        $nombreArchivo = $nombreCIF . '.' . $extension;
    
        // Guardar la imagen en la carpeta 'public'
        $imagen->move(public_path('storage/asseguradoresImages'), $nombreArchivo);

        try{
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
            return redirect('/admin/asseguradoras')->with('success', 'Aseguradora creada correctamente.');
        } catch (\Exception $e) {
            // Manejar la excepción y proporcionar una respuesta adecuada
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
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
        $request->validate([
            'nombre' => 'required|string|max:50',
            'direccion' => 'required|string|max:50',
            'precio' => 'required|numeric|digits_between:1,4',
            'habilitado' => 'required|boolean',
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($request->hasFile('logo')) {
            $imagen = $request->file('logo');
            $extension = $imagen->getClientOriginalExtension();
            $nombreArchivo = $cif . '.' . $extension;

            $imagen->move(public_path('storage/asseguradoresImages'), $nombreArchivo);
        } else {
            $nombreArchivo = $asseguradora->logo;
        }
        try {
            $asseguradora->nom = $request->nombre;
            $asseguradora->adreça = $request->direccion;
            $asseguradora->preuCursa = $request->precio;
            $asseguradora->habilitado = $request->habilitado;
            $asseguradora->logo = $request->$nombreArchivo;

            $asseguradora->update();

            // Redireccionar después de la actualización exitosa
            return redirect('/admin/asseguradoras')->with('success', 'Aseguradora actualizada correctamente.');

        } catch (\Exception $e) {
            // Manejar la excepción y proporcionar una respuesta adecuada
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }
}
