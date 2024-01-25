<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model
{
    use HasFactory;
    protected $table = 'restaurant_tables';
    protected $fillable = [
        'id', 'name', 'is_booked','user_id',
    ];
}
