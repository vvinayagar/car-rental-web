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
        return $this->belongsTo(Brand::class);//each rental model belongs to one brand
    }

    public function shop()
    {
        return $this->belongsTo(ShopLocation::class);//each rental model belongs to one shoplocation
    }

    public function rents()
    {
        return $this->hasMany(Rent::class, "rental_model_id");//each rental model can have many rents//track individually
    }

    public function categories()
    {
        return $this->hasMany(SelectedCategory::class, "rental_model_id");//Each rental model can be associated with multiple categories
    }

    public function selectedCategories()
    {
        return $this->hasMany(SelectedCategory::class, "rental_model_id");//Each rental model can be associated with multiple categories
    }

    public function plans()
    {
        return $this->hasMany(Plan::class, "rental_model_id");//Each rental model can have many rental plans
    }

    public function type()
    {
        return $this->belongsTo(Type::class);//each rental model belongs to one type
    }
}
