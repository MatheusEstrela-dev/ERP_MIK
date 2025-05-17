<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        return Produto::all(); // Lista todos os produtos
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'categoria' => 'nullable|string',
        ]);

        return Produto::create($data);
    }

    public function show(Produto $produto)
    {
        return $produto; // Exibe um produto específico
    }

    public function update(Request $request, Produto $produto)
    {
        $data = $request->validate([
            'nome' => 'sometimes|string',
            'descricao' => 'sometimes|string|nullable',
            'preco' => 'sometimes|numeric|min:0',
            'categoria' => 'sometimes|string|nullable',
        ]);

        $produto->update($data);

        return $produto;
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();

        return response()->json(['mensagem' => 'Produto excluído com sucesso.']);
    }
}
