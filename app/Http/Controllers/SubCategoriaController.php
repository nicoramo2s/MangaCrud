<?php

namespace App\Http\Controllers;

use App\Models\SubCategoria;
use Illuminate\Http\Request;

class SubCategoriaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $subcategoria = SubCategoria::create([
            'nombre' => $request->nombre,
            'categoria_id' => $request->categoria_id,
        ]);

        return response()->json($subcategoria, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategoria $subcategoria)
    {
        $request->validate([
            'nombre' => 'sometimes|string',
            'categoria_id' => 'sometimes|exists:categorias,id',
        ]);

        $subcategoria->update($request->only(['nombre', 'categoria_id']));

        return response()->json($subcategoria);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategoria $subcategoria)
    {
        $subcategoria->delete();
        return response()->json("Subcategoria $subcategoria->nombre eliminada");
    }
}
