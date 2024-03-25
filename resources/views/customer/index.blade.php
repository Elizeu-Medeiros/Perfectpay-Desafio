@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Listar Clientes') }}</div>

                <div class="card-body">
                    <a href="{{ route('clients.create') }}" class="btn btn-primary mb-2">Novo Cliente</a>
                    @if ($clients->isEmpty())
                    <p>Nenhum cliente encontrado.</p>
                    @else
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>Celular</th>
                                <th>Email</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td>{{ $client->user->name }}</td>
                                <td>{{ $client->phone }}</td>
                                <td>{{ $client->mobile_phone }}</td>
                                <td>{{ $client->user->email }}</td>
                                <td>
                                    <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info btn-sm">Detalhes</a>
                                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection