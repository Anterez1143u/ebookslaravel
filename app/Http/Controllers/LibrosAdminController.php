<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class LibrosAdminController extends Controller
{
    // Proteger todas las rutas del controlador con middleware de autenticación
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Vista principal del escritor
    public function InicioEscritor()
    {
        // Mostrar solo los libros del escritor autenticado
        $libros = Libro::where('autor_id', auth()->id())->simplePaginate(5);
        return view('escritor.InicioEscritor', compact('libros'));
    }

    // Formulario para crear libro
    public function create()
    {
        return view('escritor.create');
    }

    // Guardar libro nuevo
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'archivo_pdf' => 'required|file|mimes:pdf|max:20480',
            'portada' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $pdfPath = $request->file('archivo_pdf')->store('libros', 'public');
        $portadaPath = $request->hasFile('portada')
            ? $request->file('portada')->store('portadas', 'public')
            : null;

        Libro::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'categoria' => $request->categoria,
            'portada' => $portadaPath,
            'archivo_pdf' => $pdfPath,
            'precio' => $request->precio,
            'autor_id' => auth()->id(),
        ]);

        return redirect()->route('escritor.inicio')->with('success', 'Libro creado correctamente');
    }

    // Ver detalles de un libro
    public function show($id)
    {
        $libro = Libro::where('id', $id)->where('autor_id', auth()->id())->firstOrFail();
        return view('escritor.show', compact('libro'));
    }

    // Formulario para editar un libro
    public function edit($id)
    {
        $libro = Libro::where('id', $id)->where('autor_id', auth()->id())->firstOrFail();
        return view('escritor.edit', compact('libro'));
    }

    // Actualizar libro
    public function update(Request $request, $id)
    {
        $libro = Libro::where('id', $id)->where('autor_id', auth()->id())->firstOrFail();

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria' => 'required|string',
            'portada' => 'nullable|image|max:2048',
            'archivo_pdf' => 'nullable|mimes:pdf|max:20480',
            'precio' => 'nullable|numeric|min:0',
        ]);

        // Actualizar portada si es necesario
        if ($request->hasFile('portada')) {
            if ($libro->portada) {
                Storage::disk('public')->delete($libro->portada);
            }
            $libro->portada = $request->file('portada')->store('portadas', 'public');
        }

        // Actualizar PDF si es necesario
        if ($request->hasFile('archivo_pdf')) {
            if ($libro->archivo_pdf) {
                Storage::disk('public')->delete($libro->archivo_pdf);
            }
            $libro->archivo_pdf = $request->file('archivo_pdf')->store('libros', 'public');
        }

        $libro->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'categoria' => $request->categoria,
            'portada' => $libro->portada,
            'archivo_pdf' => $libro->archivo_pdf,
            'precio' => $request->precio ?? 0.00,
        ]);

        return redirect()->route('escritor.inicio')->with('success', 'Libro actualizado correctamente');
    }

    // Eliminar libro
    public function destroy($id)
    {
        $libro = Libro::where('id', $id)->where('autor_id', auth()->id())->firstOrFail();

        if ($libro->portada) {
            Storage::disk('public')->delete($libro->portada);
        }

        if ($libro->archivo_pdf) {
            Storage::disk('public')->delete($libro->archivo_pdf);
        }

        $libro->delete();

        return redirect()->route('escritor.inicio')->with('success', 'Libro eliminado correctamente');
    }
}
