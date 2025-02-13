<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MangaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mangas = Manga::with(['categoria', 'subcategoria'])->get();
        return response()->json($mangas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'portada' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
            'subcategoria_id' => 'required|exists:sub_categorias,id',
        ]);
    
        $portada = null;
        if ($request->hasFile('portada')) {
            $portada = $request->file('portada')->store('portadas', 'public');
        }
    
        $manga = Manga::create([
            'titulo' => $request->titulo,
            'portada' => $portada,
            'categoria_id' => $request->categoria_id,
            'subcategoria_id' => $request->subcategoria_id,
        ]);
    
        return response()->json($manga, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $manga = Manga::with(['categoria', 'subcategoria'])->findOrFail($id);
        return response()->json($manga);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $manga = Manga::findOrFail($id);

        $request->validate([
            'titulo' => 'sometimes|string|max:255',
            'portada' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'categoria_id' => 'sometimes|exists:categories,id',
            'subcategoria_id' => 'sometimes|exists:subcategories,id',
        ]);

        if ($request->hasFile('portada')) {
            if ($manga->cover_image) {
                Storage::disk('public')->delete($manga->cover_image);
            }
            $manga->cover_image = $request->file('portada')->store('portadas', 'public');
        }

        $manga->update($request->only('titulo', 'portada', 'categoria_id', 'subcategoria_id'));

        return response()->json($manga);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $manga = Manga::findOrFail($id);

        if ($manga->cover_image) {
            Storage::disk('public')->delete($manga->cover_image);
        }

        $manga->delete();

        return response()->json(['message' => "Manga $manga->titulo eliminado"]);
    }
}
