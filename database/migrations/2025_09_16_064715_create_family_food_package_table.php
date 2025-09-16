<?php

use App\Models\Family;
use App\Models\FoodPackage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('family_food_package', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Family::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(FoodPackage::class)->constrained()->cascadeOnDelete();
            $table->date('delivery_date');
            $table->date('delivered')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_food_package');
    }
};
