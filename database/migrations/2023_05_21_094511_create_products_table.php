<?php

use App\Models\Umkm;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->text('description');
            $table->foreignIdFor(Umkm::class)->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
