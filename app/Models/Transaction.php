<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subscription;
use App\Models\Transaction;


class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'subscription_plan_id',
        'amount',
        'status',
        'payment_method',
        'order_id',
        // ➕ kolom baru:
        'customer_name',
        'phone',
        'city',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id');
    }
}
