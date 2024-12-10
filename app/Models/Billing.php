<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Billing extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'company',
        'invoice_id',
        'total_amount',
        'paid_amount',
        'remaining_balance',
        'installments',
        'next_due_date',
        'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
