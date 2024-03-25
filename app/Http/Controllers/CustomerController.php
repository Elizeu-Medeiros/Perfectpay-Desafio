<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jetimob\Asaas\Facades\Asaas;
use Jetimob\Asaas\Entity\Customer\Customer as AsaasCustomer;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $user = Auth::user();
            // Verificar se o usuário possui um cliente relacionado
            $customer = $user->customer ?? null;

            return view('customer.create', compact('customer', 'user'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Customere não encontrado.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao buscar o cliente. Por favor, tente novamente.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateCustomerRequest $request, User $user)
    {

        DB::beginTransaction();

        try {
            // Obter os dados validados do formulário
            $validatedData = $request->validated();

            // Atualizar os dados do usuário
            $user->update($request->only(['name', 'email']));
            $userId = $request->user_id;

            // Verificar e associar o cliente com o usuário, se necessário
            if (!$user->customer) {
                $customer = new Customer();
                $customer->user()->associate($user);
            } else {
                $customer = $user->customer;
            }

            // Preencher os dados do cliente com os dados validados do formulário
            $customer->fill($request->all());
            $customer->save();



            // Criar o cliente no Asaas
            $asaasCustomer = $this->createAsaasCustomerFromRequest($request, $customer);
            $returnCustomer = $this->createAsaasCustomer($asaasCustomer);

            // Extrair o ID retornado pelo Asaas
            $asaasCustomerId = $returnCustomer->getId();

            // Atualizar o modelo Customer com o ID retornado pelo Asaas
            $customer->customer_id_external = $asaasCustomerId;
            $customer->save();

            DB::commit();
        } catch (\Exception $e) {
            // Lidar com qualquer exceção inesperada
            Log::error($e);
            DB::rollback();
            return redirect()->back()->with('error', 'Ocorreu um erro ao processar a solicitação. Por favor, tente novamente.');
        }
        // Redirecionar para a página apropriada após a atualização
        return redirect()->route('customer.show', ['customer' => $userId])->with('success', 'Cliente e usuário atualizados com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            // pega dados do usuário logado e seu relacionamente se existir
            $user = User::with('customer')->findOrFail($id);

            // dados do cliente
            $customer =  $user->customer;

            // Retornar a view com os detalhes do cliente
            return view('customer.show', compact('customer', 'user'));
        } catch (ModelNotFoundException $e) {
            // Redirecionar de volta com uma mensagem de erro se o cliente não for encontrado
            return redirect()->back()->with('error', 'Cliente não encontrado.');
        } catch (\Exception $e) {
            // Lidar com qualquer outra exceção inesperada
            return redirect()->back()->with('error', 'Falha ao buscar detalhes do cliente. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        try {
            // pega dados do usuário logado e seu relacionamente se existir
            $user = User::with('customer')->findOrFail($id);

            // dados do cliente
            $customer =  $user->customer;

            return view('customer.edit', compact('customer', 'user'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Customere não encontrado.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao buscar o cliente. Por favor, tente novamente.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateCustomerRequest $request, User $user)
    {
        DB::beginTransaction();

        try {
            // Obter os dados validados do formulário
            $validatedData = $request->validated();

            $user = User::with('customer')->findOrFail($request->user_id);

            // Atualizar os dados do usuário
            $user->update($request->only(['name', 'email']));
            $user->save();

            $userId = $request->user_id;

            // Verificar se o usuário possui um cliente associado
            if ($user->customer) {

                // Obter o cliente associado ao usuário
                $customer = $user->customer;

                // Atualizar os dados do cliente com os dados validados do formulário
                $customer->fill($request->all());
                $customer->save();

                // Atualizar o cliente no Asaas
                $asaasCustomer = $this->createAsaasCustomerFromRequest($request, $customer);
                $this->updateAsaasCustomer($customer, $asaasCustomer);
            }


            DB::commit();
        } catch (\Exception $e) {
            // Lidar com qualquer exceção inesperada
            Log::error($e);
            DB::rollback();
            return redirect()->back()->with('error', 'Ocorreu um erro ao processar a solicitação. Por favor, tente novamente.');
        }

        // Redirecionar para a página apropriada após a atualização
        return redirect()->route('customer.show', ['customer' => $userId])->with('success', 'Cliente e usuário atualizados com sucesso.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Cria um objeto AsaasCustomer com base nos dados do formulário.
     *
     * @param Request $request
     * @param Customer $customer
     * @return AsaasCustomer
     */
    private function createAsaasCustomerFromRequest(Request $request, Customer $customer)
    {
        $asaasCustomer = new AsaasCustomer();
        $asaasCustomer->setName($request->input('name'))
        ->setEmail($request->input('email'))
        ->setCpfCnpj($request->input('cpf_cnpj'))
        ->setPhone($request->input('phone'))
        ->setMobilePhone($request->input('mobile_phone'))
        ->setAddress($request->input('address'))
        ->setAddressNumber($request->input('address_number'))
        ->setComplement($request->input('complement'))
        ->setProvince($request->input('province'))
        ->setPostalCode($request->input('postal_code'))
        ->setExternalReference($customer->id)
            ->setNotificationDisabled($request->input('notification_disabled'))
            ->setAdditionalEmails($request->input('additional_emails'))
            ->setMunicipalInscription($request->input('municipal_inscription'))
            ->setStateInscription($request->input('state_inscription'))
            ->setObservations($request->input('observations'))
            ->setGroupName($request->input('group_name'))
            ->setCompany($request->input('company'));

        return $asaasCustomer;
    }

    protected function createAsaasCustomer($asaasCustomer)
    {
        try {
            $response = Asaas::customer()->create($asaasCustomer);

            return $response;
        } catch (\Exception $e) {
            // Lidar com erros ao criar o cliente no Asaas
            Log::error('Erro ao criar o cliente no Asaas: ' . $e->getMessage());
            throw new Exception('Erro ao criar o cliente no Asaas: ' . $e->getMessage());
        }
    }

    /**
     * Atualiza o cliente no Asaas.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return void
     * @throws \Exception
     */
    protected function updateAsaasCustomer($customer, $asaasCustomer)
    {
        try {
           
            $response = Asaas::customer()->update($customer->customer_id_external, $asaasCustomer);

        } catch (\Exception $e) {
            // Lidar com erros ao atualizar o cliente no Asaas
            Log::error('Erro ao atualizar o cliente no Asaas: ' . $e->getMessage());
            throw new \Exception('Erro ao atualizar o cliente no Asaas: ' . $e->getMessage());
        }
    }
}
