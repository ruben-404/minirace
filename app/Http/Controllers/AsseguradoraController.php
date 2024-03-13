<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asseguradora;
use Illuminate\Support\Facades\View;


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
    public function getCarrerasAseguradas($cif)
    {
        // Buscar los inscritos para la carrera específica con la relación corredor cargada
        //$inscritos = Inscrito::with('corredor')->where('idCarrera', $cif)->get();

        //return view('admin.carreras.participantes', compact('inscritos'));
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

    public function buscarAsseguradores(Request $request)
    {
        $query = $request->input('query');
        $asseguradoras = Asseguradora::where('nom', 'like', "%$query%")->get();
        $tbodyHtml = View::make('admin.asseguradores.tablaAsseguradores', ['asseguradoras' => $asseguradoras])->render();
        
        // Buscar el contenido del div con clase .tbodyCont usando expresiones regulares
        preg_match('/<div class="tbodyCont"[^>]*>(.*?)<\/div>/s', $tbodyHtml, $matches);
        $tbodyContHtml = $matches[0] ?? '';

        return $tbodyContHtml;
       
    }
}
