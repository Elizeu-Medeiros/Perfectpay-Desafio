<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePaymentRequest;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jetimob\Asaas\Facades\Asaas;
use Jetimob\Asaas\Entity\Customer\Customer as AsaasCustomer;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $payments = Payment::all();

            // Retornar a view com os detalhes do pagamento
            return view('payments.index', compact('payments'));
        } catch (ModelNotFoundException $e) {
            // Redirecionar de volta com uma mensagem de erro se o pagamento não for encontrado
            return redirect()->back()->with('error', 'Pagamento não encontrado.');
        } catch (\Exception $e) {
            // Lidar com qualquer outra exceção inesperada
            return redirect()->back()->with('error', 'Falha ao buscar detalhes do pagamento. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $user = Auth::user();
            // Verificar se o usuário possui um pagamento relacionado
            $customer = $user->customer ?? null;

            return view('payments.create', compact('customer', 'user'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Pagamento não encontrado.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao buscar o pagamento. Por favor, tente novamente.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdatePaymentRequest $request)
    {
        DB::beginTransaction();

        try {
            // Obter os dados validados do formulário
            $validatedData = $request->validated();

            dd('parei aqui');
            // Verificar e associar o cliente com o usuário, se necessário
            // if (!$user->customer) {
            //     $customer = new Customer();
            //     $customer->user()->associate($user);
            // } else {
            //     $customer = $user->customer;
            // }

            // Preencher os dados do cliente com os dados validados do formulário
            // $customer->fill($request->all());
            // $customer->save();



            // Criar pagamento no Asaas
            // $asaasPayment = $this->createAsaasPaymentFromRequest($request, $payment);
            // $returnCustomer = $this->createAsaasPayment($asaasPayment);

            // Extrair o ID retornado pelo Asaas
            // $asaasCustomerId = $returnCustomer->getId();

            // Atualizar o modelo Customer com o ID retornado pelo Asaas
            // $payment->customer_id_external = $asaasCustomerId;
            // $payment->save();

            DB::commit();
        } catch (\Exception $e) {
            // Lidar com qualquer exceção inesperada
            Log::error($e);
            DB::rollback();
            return redirect()->back()->with('error', 'Ocorreu um erro ao processar a solicitação. Por favor, tente novamente.');
        }
        // Redirecionar para a página apropriada após a atualização
        return redirect()->route('payments.show', ['payments' => $payment->id])->with('success', 'Pagamento inserido com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Cria um objeto AsaasPayment com base nos dados do formulário.
     *
     * @param Request $request
     * @param Payment $payment
     * @return AsaasCustomer
     */
    private function createAsaasCustomerFromRequest(Request $request, Payment $payment)
    {
        $asaasCustomer = new AsaasCustomer();
        $asaasCustomer->setName($request->input('name'));


        return $asaasCustomer;
    }
}
