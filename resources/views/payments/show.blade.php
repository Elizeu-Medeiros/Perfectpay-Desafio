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
                            <p><strong>ID:</strong> {{ $payment->id ?? ''}}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Nome:</strong> {{ $payment->customer->user->name }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>CPF/CNPJ:</strong> {{ $payment->customer->cpf_cnpj ?? ''}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Email:</strong> {{ $payment->customer->user->email }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Telefone:</strong> {{ $payment->customer->phone ?? '' }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Celular:</strong> {{ $payment->customer->mobile_phone ?? ''}}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-9">
                            <p><strong>Endereço:</strong> {{ $payment->customer->address ?? ''}}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Número:</strong> {{ $payment->customer->address_number ?? ''}}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Complemento:</strong> {{ $payment->customer->complement ?? ''}}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Bairro:</strong> {{ $payment->customer->province ?? ''}}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>CEP:</strong> {{ $payment->customer->postal_code ?? ''}}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Notificações Desativadas:</strong> {{ $payment ? ($payment->notification_disabled ? 'Sim' : 'Não' ) : '' }}</p>
                        </div>
                        <div class="col-md-8">
                            <p><strong>Emails Adicionais:</strong> {{ $payment->additional_emails ?? '' }}</p>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <p><strong>Nome do Grupo:</strong> {{ $payment->group_name ?? ''}}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Inscrição Municipal:</strong> {{ $payment->municipal_inscription ?? ''}}</p>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-8">
                            <p><strong>Empresa:</strong> {{ $payment->company ?? ''}}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Inscrição Estadual:</strong> {{ $payment->state_inscription ?? ''}}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>Observações:</strong> {{ $payment->observations ?? '' }}</p>
                        </div>
                    </div>

                    <a href="{{ route('home') }}" class="btn btn-secondary">Voltar</a>
                    @if ($payment)
                    <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-primary">Editar</a>
                    @else
                    <a href="{{ route('payments.create') }}" class="btn btn-primary">Castrar</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection