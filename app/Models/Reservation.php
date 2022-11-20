<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model {
    use HasFactory;

    protected $fillable = [
        'start_from',
        'end_to',
        'orderer_first_name',
        'orderer_last_name',
        'orderer_email',
        'orderer_phone',
    ];

    public function costumersInfo() {
        return $this->hasMany(ReservationCustomerInfo::class);
    }
}
