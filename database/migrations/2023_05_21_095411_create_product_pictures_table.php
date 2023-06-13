<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_pictures', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->foreignIdFor(Product::class)->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_pictures');
    }
};
