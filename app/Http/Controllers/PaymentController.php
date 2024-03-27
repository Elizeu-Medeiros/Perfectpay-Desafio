<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePaymentRequest;
use App\Models\Payment;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jetimob\Asaas\Facades\Asaas;
use Jetimob\Asaas\Entity\Charging\Charging;

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

            return view('payments.create', compact('user'));
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

            $payment = new Payment();

            // Preencher os dados do payment com os dados validados do formulário
            $payment->fill($request->all());
            $payment->save();

            // Criar pagamento no Asaas
            $asaasPayment = $this->createAsaasPaymentFromRequest($request, $payment);
            $returnPayment = $this->createAsaasPayment($asaasPayment);


            if ($returnPayment->getStatusCode() == 200) {
                $this->savePayment($payment, $returnPayment);
            }

            DB::commit();
        } catch (\Exception $e) {
            // Lidar com qualquer exceção inesperada
            Log::error($e);
            DB::rollback();
            return redirect()->back()->with('error', 'Ocorreu um erro ao processar a solicitação. Por favor, tente novamente.');
        }
        // Redirecionar para a página apropriada após a atualização
        return redirect()->route('payments.index', ['payments' => $payment->id])->with('success', 'Pagamento inserido com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            // pega dados do usuário logado e seu relacionamente se existir
            $payment = Payment::find($id);

            // Retornar a view com os detalhes do payment
            return view('payments.show', compact('payment'));
        } catch (ModelNotFoundException $e) {
            // Redirecionar de volta com uma mensagem de erro se o payment não for encontrado
            return redirect()->back()->with('error', 'Pagamento não encontrado.');
        } catch (\Exception $e) {
            // Lidar com qualquer outra exceção inesperada
            return redirect()->back()->with('error', 'Falha ao buscar detalhes do payment. ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {

            // pega dados do usuário logado e seu relacionamente se existir
            $payment = Payment::find($id);
            $user = $payment->customer->user;

            // Retornar a view com os detalhes do payment
            return view('payments.edit', compact('payment', 'user'));
        } catch (ModelNotFoundException $e) {
            // Redirecionar de volta com uma mensagem de erro se o payment não for encontrado
            return redirect()->back()->with('error', 'Pagamento não encontrado.');
        } catch (\Exception $e) {
            // Lidar com qualquer outra exceção inesperada
            return redirect()->back()->with('error', 'Falha ao buscar detalhes do payment. ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdatePaymentRequest $request, string $id)
    {
        DB::beginTransaction();

        try {
            // Obter os dados validados do formulário
            $validatedData = $request->validated();

            $payment = Payment::find($id);
            $payment->fill($request->all());
            $payment->save();

            // Atualizar o payment no Asaas
            $asaasPayment = $this->createAsaasPaymentFromRequest($request, $payment);
            $this->updateAsaasPayment($payment, $asaasPayment);

            DB::commit();
        } catch (\Exception $e) {
            // Lidar com qualquer exceção inesperada
            Log::error($e);
            DB::rollback();
            return redirect()->back()->with('error', 'Ocorreu um erro ao processar a solicitação. Por favor, tente novamente.');
        }

        // Redirecionar para a página apropriada após a atualização
        return redirect()->route('payments.index')->with('success', 'Pagamento atualizados com sucesso.');
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
     * @return AsaasPayment
     */
    private function createAsaasPaymentFromRequest(Request $request, Payment $payment)
    {
        $charging = new Charging;
        $charging->setCustomer($request->input('customer'))
        ->setDueDate($request->input('due_date'))
        ->setBillingType($request->input('billing_type'))
        ->setValue($request->input('value'))
            ->setDescription($request->input('description'))
            ->setExternalReference($payment->id)
            ->setInstallmentCount($request->input('isntallment_count'))
            // ->setTotalValue($request->input('name'))
            // ->setDescription($request->input('name'))
            // ->setDescription($request->input('name'))
            // ->setDescription($request->input('name'))
            // ->setDescription($request->input('name'))
        ;

        return $charging;
    }

    protected function createAsaasPayment($asaasPayment)
    {
        try {
            $response = Asaas::charging()->create($asaasPayment);

            return $response;
        } catch (\Exception $e) {
            // Lidar com erros ao criar o payment no Asaas
            Log::error('Erro ao criar o payment no Asaas: ' . $e->getMessage());
            throw new Exception('Erro ao criar o payment no Asaas: ' . $e->getMessage());
        }
    }

    /**
     * Atualiza o payment no Asaas.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return void
     * @throws \Exception
     */
    protected function updateAsaasPayment($payment, $asaasPayment)
    {
        try {

            $response = Asaas::charging()->update($payment->external_reference, $asaasPayment);
        } catch (\Exception $e) {
            // Lidar com erros ao atualizar o pagamento no Asaas
            Log::error('Erro ao atualizar o pagamento no Asaas: ' . $e->getMessage());
            throw new \Exception('Erro ao atualizar o pagamento no Asaas: ' . $e->getMessage());
        }
    }

    public function savePayment(Payment $payment, $returnPayment)
    {
        // Atualizar o modelo Payment com o retornado pelo Asaas
        $payment->external_reference = $returnPayment->getId();
        $payment->invoice_number = $returnPayment->getInvoiceNumber();
        $payment->status = $returnPayment->getStatus();
        $payment->invoice_url = $returnPayment->getInvoiceUrl();

        if ($returnPayment->getBillingType() == "BOLETO") {
            $payment->bank_slip_url = $returnPayment->getBankSlipUrl();
            $payment->nosso_numero = $returnPayment->getNossoNumero();
        }

        $payment->save();
    }
}
