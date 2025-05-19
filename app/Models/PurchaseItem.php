<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_model_id',
        'purchase_id',
        'price',
        'address',
        'status',
        'quantity',
'plan_id',
'days',
'start_date',
'end_date'
    ];

    public function rentalModel()
    {
        return $this->belongsTo(RentalModel::class);//Each purchase item is for one specific car model
    }

    public function plan(){
        return $this->belongsTo(Plan::class);//Each item also uses a rental plan
    }
}
