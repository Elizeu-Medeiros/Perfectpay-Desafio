@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <!-- Se houver erros de validação, exiba as mensagens de erro -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <h1>Como Usar o Sistema</h1>
                    <br>
                    <h3>Cadastro de Cliente:</h3>
                    <ul>
                        <li>No menu superior à direita, clique para expandir os menus e selecione "Meus Dados".</li>
                        <li>Preencha o formulário com as informações do cliente.</li>
                        <li>Clique em "Cadastrar" para confirmar o cadastro do cliente.</li>
                    </ul>

                    <h3>Atualização de Cliente:</h3>
                    <ul>
                        <li>Para editar as informações de "Meus dados".</li>
                        <li>No menu superior à direita, clique para expandir os menus e selecione "Meus Dados".</li>
                        <li>Clique em "Editar".</li>
                        <li>Faça as alterações desejadas no formulário.</li>
                        <li>Clique em "Atualizar".</li>
                    </ul>

                    <h3>Gerar Pagamento:</h3>
                    <ul>
                        <li>No menu superior à direita, clique para expandir os menus e selecione "Pagamento".</li>
                        <li>Na Lista de Pagamentos, Clique em "Novo Pagamento".</li>
                        <li>Preencha o formulário com as informações obrigatórias.</li>
                        <li>Clique em "Cadastrar".</li>
                    </ul>

                    <h3>Efetuar Pagamento:</h3>
                    <ul>
                        <li>Após realizar o cadastro, você será redirecionado para a lista com as os pagamentos.</li>
                        <li>Na Lista de Pagamentos, selecione e Clique no botão na coluna de Pagamento.</li>
                        <li>Faça o pagamento conforme forma de pagamento selecionado</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection