<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model {
    use HasFactory;

    protected $fillable = [
        'table_number',
        'restaurant_id',
        'chairs',
    ];

    public function reservations() {
        return $this->hasMany(ReservationTable::class);
    }
}
