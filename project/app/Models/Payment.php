<?php

namespace App\Models;

use App\Interfaces\Payable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model implements Payable
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'property_owner_id',
        'amount',
        'description',
        'payment_link',
        'status',
    ];

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    public function propertyOwner()
    {
        return $this->belongsTo(User::class, 'property_owner_id');
    }

    public function getPayableName()
    {
        return $this->tenant->name;
    }

    public function getPayableEmail()
    {
        return $this->tenant->email;
    }

    public function getPayableAmount()
    {
        return $this->amount;
    }

    public function getPayableDescription()
    {
        return $this->description;
    }

    public function getSuccessUrl()
    {
        return route('payment.success') . '?payment_id=' . $this->id;
    }

    public function getCancelUrl()
    {
        return route('payment.cancel') . '?payment_id=' . $this->id;
    }
}
