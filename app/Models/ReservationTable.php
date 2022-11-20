<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationTable extends Model {
    use HasFactory;

    protected $fillable = [
        'restaurant_table_id',
        'reservation_id',
        'start_from',
        'end_to',
    ];
}
