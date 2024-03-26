<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store(Request $request)
    {
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
}
