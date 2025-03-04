<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use Illuminate\Support\Facades\Storage;

class LibrosAdminController extends Controller
{
  

    // 📌 Vista principal del escritor
    public function InicioEscritor()
    {
        $libros = Libro::where('autor_id', auth()->id())->get(); // Solo los libros del escritor autenticado
        return view('escritor.InicioEscritor', compact('libros'));
    }

    // 📌 Formulario para agregar un nuevo libro
    public function create()
    {
        return view('escritor.create');
    }

    // 📌 Guardar un nuevo libro
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria' => 'required|string',
            'portada' => 'nullable|image|max:2048',
            'archivo_pdf' => 'required|mimes:pdf|max:10000',
            'precio' => 'nullable|numeric|min:0',
        ]);

        // Guardar la portada (si hay)
        $portadaPath = $request->file('portada') ? $request->file('portada')->store('portadas', 'public') : null;
        $archivoPath = $request->file('archivo_pdf')->store('libros', 'public');

        // Crear libro
        Libro::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'autor_id' => auth()->id(),
            'categoria' => $request->categoria,
            'portada' => $portadaPath,
            'archivo_pdf' => $archivoPath,
            'precio' => $request->precio ?? 0.00,
        ]);

        return redirect()->route('escritor.inicio')->with('success', 'Libro agregado correctamente');
    }

    // 📌 Ver un libro (opcional)
    public function show($id)
    {
        $libro = Libro::where('id', $id)->where('autor_id', auth()->id())->firstOrFail();
        return view('escritor.show', compact('libro'));
    }

    // 📌 Formulario para editar un libro
    public function edit($id)
    {
        $libro = Libro::where('id', $id)->where('autor_id', auth()->id())->firstOrFail();
        return view('escritor.edit', compact('libro'));
    }

    // 📌 Actualizar un libro
    public function update(Request $request, $id)
    {
        $libro = Libro::where('id', $id)->where('autor_id', auth()->id())->firstOrFail();

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria' => 'required|string',
            'portada' => 'nullable|image|max:2048',
            'archivo_pdf' => 'nullable|mimes:pdf|max:10000',
            'precio' => 'nullable|numeric|min:0',
        ]);

        if ($request->hasFile('portada')) {
            if ($libro->portada) {
                Storage::disk('public')->delete($libro->portada);
            }
            $libro->portada = $request->file('portada')->store('portadas', 'public');
        }

        if ($request->hasFile('archivo_pdf')) {
            Storage::disk('public')->delete($libro->archivo_pdf);
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

    // 📌 Eliminar un libro
    public function destroy($id)
    {
        $libro = Libro::where('id', $id)->where('autor_id', auth()->id())->firstOrFail();
        
        if ($libro->portada) {
            Storage::disk('public')->delete($libro->portada);
        }
        Storage::disk('public')->delete($libro->archivo_pdf);
        
        $libro->delete();

        return redirect()->route('escritor.inicio')->with('success', 'Libro eliminado correctamente');
    }
}
