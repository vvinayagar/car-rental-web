<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\PurchaseItem;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'transaction_id',
        'amount',
        'address',
        'status',
        'approval_status',
        'quantity',
        'payment_type',
        'payment_name',
        'shop'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class, "purchase_id");
    }
}
