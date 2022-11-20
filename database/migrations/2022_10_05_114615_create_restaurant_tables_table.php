<?php

declare(strict_types=1);

use App\Models\Restaurant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('restaurant_tables', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Restaurant::class)->references('id')
                ->on('restaurants')
                ->onDelete('cascade');
            $table->integer('table_number');
            $table->integer('chairs');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('restaurant_tables');
    }
};
