<?php

namespace App\Models;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cpf_cnpj',
        'phone',
        'mobile_phone',
        'address',
        'address_number',
        'complement',
        'province',
        'postal_code',
        'external_reference',
        'notification_disabled',
        'additional_emails',
        'municipal_inscription',
        'state_inscription',
        'observations',
        'group_name',
        'company',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

}
