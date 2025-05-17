<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        return Pedido::with('usuario')->get(); // Lista todos os pedidos com o usuário relacionado
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'data_pedido' => 'required|date',
            'valor_total' => 'required|numeric|min:0',
            'status' => 'required|string', // ex: "pendente", "concluído"
        ]);

        return Pedido::create($data);
    }

    public function show(Pedido $pedido)
    {
        return $pedido->load('usuario'); // Mostra o pedido com o usuário relacionado
    }

    public function update(Request $request, Pedido $pedido)
    {
        $data = $request->validate([
            'usuario_id' => 'sometimes|exists:usuarios,id',
            'data_pedido' => 'sometimes|date',
            'valor_total' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|string',
        ]);

        $pedido->update($data);

        return $pedido;
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return response()->json(['mensagem' => 'Pedido excluído com sucesso.']);
    }
}
