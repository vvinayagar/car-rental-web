<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    public function rental(){
        return $this->belongsTo(RentalModel::class, "rental_model_id");
    }
}
