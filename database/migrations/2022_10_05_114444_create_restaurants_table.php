<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('table_count')->default(0);
            $table->integer('max_customers')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('restaurants');
    }
};
