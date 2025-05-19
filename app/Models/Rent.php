<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Rent extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);//Each rent belongs to one user
    }

}
