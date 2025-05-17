<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    public function index()
    {
        return Estoque::with('produto')->get(); // Lista todos os estoques com o produto vinculado
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:0',
            'localizacao' => 'nullable|string',
        ]);

        return Estoque::create($data);
    }

    public function show(Estoque $estoque)
    {
        return $estoque->load('produto'); // Mostra o estoque com o produto relacionado
    }

    public function update(Request $request, Estoque $estoque)
    {
        $data = $request->validate([
            'produto_id' => 'sometimes|exists:produtos,id',
            'quantidade' => 'sometimes|integer|min:0',
            'localizacao' => 'sometimes|string|nullable',
        ]);

        $estoque->update($data);

        return $estoque;
    }

    public function destroy(Estoque $estoque)
    {
        $estoque->delete();

        return response()->json(['mensagem' => 'Registro de estoque removido com sucesso.']);
    }
}
