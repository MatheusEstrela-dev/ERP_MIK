<?php

namespace App\Http\Controllers;

use App\Models\Cupom;
use Illuminate\Http\Request;

class CupomController extends Controller
{
    public function index()
    {
        return Cupom::all(); // Lista todos os cupons
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'codigo' => 'required|string|unique:cupoms,codigo',
            'tipo' => 'required|in:percentual,fixo',
            'valor' => 'required|numeric|min:0',
            'data_validade' => 'nullable|date',
            'ativo' => 'required|boolean',
        ]);

        return Cupom::create($data);
    }

    public function show(Cupom $cupom)
    {
        return $cupom; // Exibe um cupom específico
    }

    public function update(Request $request, Cupom $cupom)
    {
        $data = $request->validate([
            'codigo' => 'sometimes|string|unique:cupoms,codigo,' . $cupom->id,
            'tipo' => 'sometimes|in:percentual,fixo',
            'valor' => 'sometimes|numeric|min:0',
            'data_validade' => 'sometimes|date|nullable',
            'ativo' => 'sometimes|boolean',
        ]);

        $cupom->update($data);

        return $cupom;
    }

    public function destroy(Cupom $cupom)
    {
        $cupom->delete();

        return response()->json(['mensagem' => 'Cupom excluído com sucesso.']);
    }
}
