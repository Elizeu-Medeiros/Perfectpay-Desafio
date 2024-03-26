@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Detalhes do Cliente') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <p><strong>ID:</strong> {{ $customer->id ?? ''}}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Nome:</strong> {{ $user->name }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>CPF/CNPJ:</strong> {{ $customer->cpf_cnpj ?? ''}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Telefone:</strong> {{ $customer->phone ?? '' }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Celular:</strong> {{ $customer->mobile_phone ?? ''}}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-9">
                            <p><strong>Endereço:</strong> {{ $customer->address ?? ''}}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Número:</strong> {{ $customer->address_number ?? ''}}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Complemento:</strong> {{ $customer->complement ?? ''}}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Bairro:</strong> {{ $customer->province ?? ''}}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>CEP:</strong> {{ $customer->postal_code ?? ''}}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Notificações Desativadas:</strong> {{ $customer ? ($customer->notification_disabled ? 'Sim' : 'Não' ) : '' }}</p>
                        </div>
                        <div class="col-md-8">
                            <p><strong>Emails Adicionais:</strong> {{ $customer->additional_emails ?? '' }}</p>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <p><strong>Nome do Grupo:</strong> {{ $customer->group_name ?? ''}}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Inscrição Municipal:</strong> {{ $customer->municipal_inscription ?? ''}}</p>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-8">
                            <p><strong>Empresa:</strong> {{ $customer->company ?? ''}}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Inscrição Estadual:</strong> {{ $customer->state_inscription ?? ''}}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>Observações:</strong> {{ $customer->observations ?? '' }}</p>
                        </div>
                    </div>

                    <a href="{{ route('home') }}" class="btn btn-secondary">Voltar</a>
                    @if ($customer)
                    <a href="{{ route('customer.edit', $user->id) }}" class="btn btn-primary">Editar</a>
                    @else
                    <a href="{{ route('customer.create') }}" class="btn btn-primary">Castrar</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection