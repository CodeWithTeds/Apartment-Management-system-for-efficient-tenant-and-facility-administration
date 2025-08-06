<?php

namespace App\Models;

use App\Interfaces\Payable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model implements Payable
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'billing_email',
        'subscription_plan',
        'billing_cycle',
        'start_date',
        'renewal_date',
        'amount',
        'status',
        'payment_status',
        'payment_method',
        'payment_link',
        'notes',
        'last_payment_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'renewal_date' => 'date',
        'last_payment_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function getPayableName()
    {
        return $this->user->name;
    }

    public function getPayableEmail()
    {
        return $this->billing_email;
    }

    public function getPayableAmount()
    {
        return $this->amount;
    }

    public function getPayableDescription()
    {
        return $this->subscription_plan . ' Subscription';
    }

    public function getSuccessUrl()
    {
        return route('payment.success') . '?subscription_id=' . $this->id;
    }

    public function getCancelUrl()
    {
        return route('payment.cancel') . '?subscription_id=' . $this->id;
    }
}
