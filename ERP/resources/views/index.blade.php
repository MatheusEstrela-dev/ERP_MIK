@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Produtos Cadastrados</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('produtos.create') }}" class="btn btn-primary mb-3">Cadastrar Novo Produto</a>

    @foreach($produtos as $produto)
        <div class="card mb-3">
            <div class="card-header">
                <strong>{{ $produto->nome }}</strong> - R$ {{ number_format($produto->preco, 2, ',', '.') }}
            </div>
            <div class="card-body">
                @if($produto->estoques->count())
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Variação</th>
                                <th>Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produto->estoques as $estoque)
                                <tr>
                                    <td>{{ $estoque->variacao ?? 'N/A' }}</td>
                                    <td>{{ $estoque->quantidade }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">Nenhuma variação cadastrada.</p>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
