@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Editar Pagamento') }}</div>

                <div class="card-body">

                    @include('payments.partials.form', ['action' => route('payments.update', $payment->id), 'method' => 'PUT'])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection