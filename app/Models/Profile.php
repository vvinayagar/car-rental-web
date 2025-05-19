<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable= ['address', 'phone', 'image', 'user_id', 'shop_location_id'];
    public function shop()
    {
        return $this->belongsTo(ShopLocation::class, "shop_location_id");
    }
    //Each profile belongs to one shop location,The foreign key in the profiles table is shop_location_id

}
