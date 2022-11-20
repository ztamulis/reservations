<?php

use App\Models\Reservation;
use App\Models\RestaurantTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('reservation_tables', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(RestaurantTable::class)->references('id')
                ->on('restaurant_tables')
                ->onDelete('cascade');
            $table->foreignIdFor(Reservation::class)->references('id')
                ->on('reservations')
                ->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('reservation_tables');
    }
};
