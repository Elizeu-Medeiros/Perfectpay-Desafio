<!-- Formulário parcial para campos do paymente -->
<!-- Formulário de criação ou edição de paymente -->
<form action="{{ isset($payment) ? route('payments.update', $payment->id) : route('payments.store') }}" method="POST">
    @csrf
    @if (isset($payment))
    @method('PUT')
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

    <!-- Campos ocultos -->
    <input type="hidden" name="id" value="{{ isset($payment) ? $payment->id : '' }}">
    <input type="hidden" name="customer" value="{{ isset($user->customer) ? $user->customer->customer_id_external : '' }}">
    <input type="hidden" name="payment_id" value="{{ isset($user->payment) ? $user->payment->id : '' }}">

    <div class="row">
        <div class="col-md-8">
            <div class="mb-3 ">
                <label class="form-label" for="cpf_cnpj">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ isset($user) ? $user->name : old('name')  }}" required>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label" for="billing_type">Forma de Pagamento</label>
                <select name="billing_type" id="billing_type" class="form-control">
                    <option value="UNDEFINED">Indefinido</option>
                    <option value="PIX">PIX</option>
                    <option value="BOLETO">Boleto Bancário</option>
                    <option value="CREDIT_CARD">Cartão de Crédito</option>
                </select>
                @error('billing_type')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Valor da cobrança PIX -->
        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label" for="value">Valor da Cobrança</label>
                <input type="number" step="0.01" class="form-control" id="value" name="value">
            </div>
        </div>

        <!-- Data de vencimento da cobrança -->
        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label" for="due_date">Data de Vencimento</label>
                <input type="date" class="form-control" id="due_date" name="due_date">
            </div>
        </div>

    </div>

    <div class="row">
        <!-- Descrição da cobrança -->
        <div class="col-md-12">
            <div class="mb-3">
                <label class="form-label" for="description">Descrição da Cobrança</label>
                <textarea class="form-control" id="description" name="description" rows="3" maxlength="500"></textarea>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Dias após o vencimento para cancelamento do registro -->
        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label" for="days_to_cancel">Dias para Cancelamento</label>
                <input type="number" class="form-control" id="days_to_cancel" name="days_to_cancel">
            </div>
        </div>

        <!-- Número de parcelas -->
        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label" for="installment_count">Número de Parcelas</label>
                <input type="number" class="form-control" id="installment_count" name="installment_count">
            </div>
        </div>

        <!-- Valor total da cobrança parcelada -->
        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label" for="total_value">Valor Total da Cobrança Parcelada</label>
                <input type="number" step="0.01" class="form-control" id="total_value" name="total_value">
            </div>
        </div>


        <!-- Valor de cada parcela -->
        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label" for="installment_value">Valor de Cada Parcela</label>
                <input type="number" step="0.01" class="form-control" id="installment_value" name="installment_value">
            </div>
        </div>
    </div>
    <!-- Informações de desconto -->
    <div class="mb-3">
        <label class="form-label" for="discount_value">Valor do Desconto</label>
        <input type="number" step="0.01" class="form-control" id="discount_value" name="discount_value">
    </div>

    <!-- Dias antes do vencimento para aplicar desconto -->
    <div class="mb-3">
        <label class="form-label" for="discount_days">Dias para Aplicar Desconto</label>
        <input type="number" class="form-control" id="discount_days" name="discount_days">
    </div>

    <!-- Percentual de juros -->
    <div class="mb-3">
        <label class="form-label" for="interest_value">Percentual de Juros</label>
        <input type="number" step="0.01" class="form-control" id="interest_value" name="interest_value">
    </div>

    <!-- Percentual de multa -->
    <div class="mb-3">
        <label class="form-label" for="fine_value">Percentual de Multa</label>
        <input type="number" step="0.01" class="form-control" id="fine_value" name="fine_value">
    </div>


    <!-- Botão de enviar -->
    <button type="submit" class="btn btn-primary">{{isset($payment) ?  __('Atualizar') : __('Cadastrar') }}</button>
</form>