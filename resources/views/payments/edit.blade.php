@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Editar Cliente') }}</div>

                <div class="card-body">

                    @include('customer.partials.form', ['action' => route('customer.update', $customer->id), 'method' => 'PUT'])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection