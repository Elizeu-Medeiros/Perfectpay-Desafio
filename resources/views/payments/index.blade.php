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
                                <th>Forma de Pagamento</th>
                                <th>Valor</th>
                                <th>Vencimento</th>
                                <th>Dt. Cadastro</th>
                                <th>Pagamento</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->customer->user->name }}</td>
                                <td>{{ $payment->billing_type }}</td>
                                <td>R$ {{ number_format($payment->value, 2, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($payment->due_date)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($payment->creadted_at)->format('d/m/Y - H:m') }}</td>
                                <td>
                                    @if ($payment->billing_type === 'PIX')
                                    <a href="{{ $payment->pix_link }}" target="_brank" class="btn btn-primary btn-sm">
                                        <i class="fas fa-credit-card fa-sm"></i> Pagar com PIX</a>
                                    @elseif ($payment->billing_type === 'BOLETO')
                                    <a href="{{ $payment->bank_slip_url }}" target="_brank" class="btn btn-info btn-sm">
                                        <i class="fas fa-credit-card fa-sm"></i> Pagar com Boleto Bancário</a>
                                    @elseif ($payment->billing_type === 'CREDIT_CARD')
                                    <a href="{{ $payment->credit_card_link }}" target="_brank" class="btn btn-success btn-sm">
                                        <i class="fas fa-credit-card fa-sm"></i> Pagar com Cartão de Crédito</a>
                                    @else
                                    <a href="{{ $payment->invoice_url }}" target="_brank" class="btn btn-success btn-sm">
                                        <i class="fas fa-dollar-sign fa-sm"></i> Escolhar uma opção de pagamento
                                    </a>
                                    @endif

                                </td>
                                <td>

                                    <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-info btn-sm" title="Detalhes">
                                        <i class="fas fa-info-circle fa-sm"></i>
                                    </a>

                                    <span style="margin-right: 5px;"></span> <!-- Espaçamento entre os botões -->

                                    <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-primary btn-sm" title="Editar">
                                        <i class="fas fa-edit fa-sm"></i>
                                    </a>

                                    <span style="margin-right: 5px;"></span> <!-- Espaçamento entre os botões -->

                                    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este pagamento?')" title="Excluir">
                                            <i class="fas fa-trash-alt fa-sm"></i>
                                        </button>
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