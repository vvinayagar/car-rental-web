<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;

class SelectedCategory extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);//Each selected category belongs to one category
    }

    public function user()
    {
        return $this->belongsTo(User::class);//Each selection belongs to one user.
    }
}
