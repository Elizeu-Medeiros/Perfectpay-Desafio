<!-- Formulário parcial para campos do customere -->
<!-- Formulário de criação ou edição de customere -->
<form action="{{ isset($customer) ? route('customer.update', $customer->id) : route('customer.store') }}" method="POST">
    @csrf
    @if (isset($customer))
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
    <input type="hidden" name="user_id" value="{{ isset($user) ? $user->id : '' }}">
    <input type="hidden" name="customer_id" value="{{ isset($customer) ? $customer->id : '' }}">

    <div class="row">
        <div class="col-md-8">
            <div class="mb-3 ">
                <label for="cpf_cnpj" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ isset($user) ? $user->name : old('name')  }}" required>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="cpf_cnpj" class="form-label">CPF ou CNPJ</label>
                <input type="text" class="form-control require" id="cpf_cnpj" name="cpf_cnpj" value="{{ isset($customer) ? $customer->cpf_cnpj : old('cpf_cnpj')  }}">
                @error('cpf_cnpj')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ isset($user) ? $user->email : old('email')  }}">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <label for="phone" class="form-label">Fone fixo</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ isset($customer) ? $customer->phone : old('phone')  }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <label for="mobile_phone" class="form-label">Fone celular</label>
                <input type="text" class="form-control" id="mobile_phone" name="mobile_phone" value="{{ isset($customer) ? $customer->mobile_phone : old('mobile_phone')  }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="mb-3">
                <label for="address" class="form-label">Logradouro</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ isset($customer) ? $customer->address : old('address')  }}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <label for="address_number" class="form-label">Número do endereço</label>
                <input type="text" class="form-control" id="address_number" name="address_number" value="{{ isset($customer) ? $customer->address_number : old('address_number')  }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="complement" class="form-label">Complemento</label>
                <input type="text" class="form-control" id="complement" name="complement" value="{{ isset($customer) ? $customer->complement : old('complement')  }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="province" class="form-label">Bairro</label>
                <input type="text" class="form-control" id="province" name="province" value="{{ isset($customer) ? $customer->province : old('province')  }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="postal_code" class="form-label">CEP do endereço</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ isset($customer) ? $customer->postal_code : old('postal_code')  }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="notification_disabled" class="form-label">Desabilitar notificações</label>
                <select class="form-select" id="notification_disabled" name="notification_disabled">
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>
            </div>
        </div>
        <div class="col-md-8">
            <div class="mb-3">
                <label for="additional_emails" class="form-label">Emails adicionais para notificações</label>
                <input type="text" class="form-control" id="additional_emails" name="additional_emails" value="{{ isset($customer) ? $customer->additional_emails : old('additional_emails')  }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="mb-3">
                <label for="group_name" class="form-label">Nome do grupo</label>
                <input type="text" class="form-control" id="group_name" name="group_name" value="{{ isset($customer) ? $customer->group_name : old('group_name')  }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="municipal_inscription" class="form-label">Inscrição municipal</label>
                <input type="text" class="form-control" id="municipal_inscription" name="municipal_inscription" value="{{ isset($customer) ? $customer->municipal_inscription : old('municipal_inscription')  }}">
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="mb-3">
                <label for="company" class="form-label">Empresa</label>
                <input type="text" class="form-control" id="company" name="company" value="{{ isset($customer) ? $customer->company : old('company')  }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="state_inscription" class="form-label">Inscrição estadual</label>
                <input type="text" class="form-control" id="state_inscription" name="state_inscription" value="{{ isset($customer) ? $customer->state_inscription : old('state_inscription')  }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="observations" class="form-label">Observações</label>
                <textarea class="form-control" id="observations" name="observations"> {{ isset($customer) ? $customer->observations : old('state_inscription')  }}</textarea>
            </div>
        </div>
    </div>

    <!-- Botão de enviar -->
    <button type="submit" class="btn btn-primary">{{isset($customer) ?  __('Atualizar') : __('Cadastrar') }}</button>
</form>