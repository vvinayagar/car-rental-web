<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\ShopLocation;
use App\Models\Rent;

class RentalModel extends Model
{
    use HasFactory;

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function shop()
    {
        return $this->belongsTo(ShopLocation::class);
    }

    public function rents()
    {
        return $this->hasMany(Rent::class,"rental_model_id" );
    }

    public function categories()
    {
        return $this->hasMany(SelectedCategory::class, "rental_model_id");
    }

    public function selectedCategories()
    {
        return $this->hasMany(Rent::class, "rental_model_id");
    }

    public function plans()
    {
        return $this->hasMany(Plan::class,"rental_model_id");
    }
}
