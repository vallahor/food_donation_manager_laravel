<?php

use App\Models\FoodPackage;
use App\Models\Item;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('food_package_item', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(FoodPackage::class);
            $table->foreignIdFor(Item::class);
            $table->integer('package_quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_package_item');
    }
};
