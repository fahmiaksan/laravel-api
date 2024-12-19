<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutDetail extends Model
{
    use HasFactory;

    protected $fillable = ['checkout_id', 'product_id', 'quantity', 'price', 'subtotal'];

    public function checkout()
    {
        return $this->belongsTo(Checkout::class);
    }
}
