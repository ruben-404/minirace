<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sponsor;
use App\Http\Controllers\CarreraController;


class SponsorController extends Controller
{
    public function getSponsors()
    {
        $sponsors = Sponsor::all();
        return view('admin.sponsors.tablaSponsors', compact('sponsors'));
    }
    public function addSponsor()
    {
        return view('admin.sponsors.formularios.addSponsors');
    }

    public function guardar(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'cif' => 'required|string|max:255',
            'nombre' => 'required|string',
            'direccion' => 'required|string',
            'destacado' => 'required|boolean',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagen = $request->file('logo');
        $nombreCIF = $request->cif;
        $extension = $imagen->getClientOriginalExtension();
        $nombreArchivo = $nombreCIF . '.' . $extension;
    
        // Guardar la imagen en la carpeta 'public'
        $imagen->move(public_path('storage/sponsorsImages'), $nombreArchivo);


        // Crear una nueva instancia de Sponsor y asignar los valores
        $sponsor = new Sponsor();
        $sponsor->cif = $request->cif;
        $sponsor->nom = $request->nombre;
        $sponsor->adreça = $request->direccion;
        $sponsor->logo = $nombreArchivo;
        $sponsor->destacat = $request->destacado;

        // Guardar el sponsor en la base de datos
        $sponsor->save();

        // Redirigir a la página de lista de sponsors u otra página según sea necesario
        return redirect('/admin/sponsors');
    }

    public function editar($cif)
    {
        // Obtener el sponsor por su CIF
        $sponsor = Sponsor::findOrFail($cif);

        // Devolver la vista de edición con los datos del sponsor
        return view('admin.sponsors.formularios.editarSponsors', compact('sponsor'));
    }

    public function actualizar(Request $request, $cif)
    {
        $sponsor = Sponsor::findOrFail($cif);
        
        $imagen = $request->file('logo');
        $extension = $imagen->getClientOriginalExtension();
        $nombreArchivo = $cif . '.' . $extension;

        $imagen->move(public_path('storage/sponsorsImages'), $nombreArchivo);

        $sponsor->update([
            'nom' => $request->input('nom'),
            'adreça' => $request->input('direccion'),
            'destacat' => $request->input('destacado'),
            'logo' => $nombreArchivo
        ]);
        
        return redirect('/admin/sponsors');
    }


}
