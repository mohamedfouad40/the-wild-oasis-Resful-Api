<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->decimal('total_price');
            $table->boolean('is_paid');
            $table->integer('num_nights');
            $table->integer('num_guests');
            $table->boolean('has_breakfast');
            $table->integer('guest_id');
            $table->integer('cabin_id')->uniqid();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
