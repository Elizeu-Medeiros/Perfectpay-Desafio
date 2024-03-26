@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Cadastrar Cliente') }}</div>

                <div class="card-body">
                    <!-- <h1>Novo Cliente</h1> -->
                    @include('payments.partials.form', ['action' => route('payments.store')])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection