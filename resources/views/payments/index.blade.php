@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Listar de Pagamentos') }}</div>

                <div class="card-body">
                    <a href="{{ route('payments.create') }}" class="btn btn-primary mb-2">Novo Pagamento</a>
                    @if ($payments->isEmpty())
                    <p>Nenhum paymente encontrado.</p>
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
                            @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->user->name }}</td>
                                <td>{{ $payment->payment->phone }}</td>
                                <td>{{ $payment->payment->mobile_phone }}</td>
                                <td>{{ $payment->user->email }}</td>
                                <td>
                                    <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-info btn-sm">Detalhes</a>
                                    <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este paymente?')">Excluir</button>
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