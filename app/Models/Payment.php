<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'customer_id', // ID do cliente associado a este pagamento
        'billing_type',
        'value',
        'due_date',
        'description',
        'days_after_due_date_to_registration_cancellation',
        'external_reference',
        'installment_count',
        'total_value',
        'installment_value',
        'discount',
        'interest',
        'fine',
        'postal_service',
        'split',
        'callback'
    ];

    // Relação com a model Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    
}
