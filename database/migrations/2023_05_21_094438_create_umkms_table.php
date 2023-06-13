<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('since');
            $table->string('nib')->unique();
            $table->text('address');

            $table->boolean('has_bpom')->default(false);
            $table->boolean('has_pirt')->default(false);
            $table->boolean('has_halal')->default(false);

            $table->string('owner');
            $table->string('phone')->unique();
            
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
