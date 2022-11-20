<?php

declare(strict_types=1);

use App\Models\RestaurantTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('reservations', function (Blueprint $table): void {
            $table->id();
            $table->timestamp('start_from');
            $table->timestamp('end_to');
            $table->string('orderer_first_name');
            $table->string('orderer_last_name');
            $table->string('orderer_email');
            $table->string('orderer_phone');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('reservations');
    }
};
