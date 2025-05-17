<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        return Usuario::all(); // Listar todos
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string',
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'required|string|min:6',
        ]);

        $data['senha'] = bcrypt($data['senha']);

        return Usuario::create($data);
    }

    public function show(Usuario $usuario)
    {
        return $usuario;
    }

    public function update(Request $request, Usuario $usuario)
    {
        $data = $request->validate([
            'nome' => 'sometimes|string',
            'email' => 'sometimes|email|unique:usuarios,email,' . $usuario->id,
            'senha' => 'sometimes|string|min:6',
        ]);

        if (isset($data['senha'])) {
            $data['senha'] = bcrypt($data['senha']);
        }

        $usuario->update($data);
        return $usuario;
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return response()->json(['mensagem' => 'Usuário removido com sucesso.']);
    }
}
