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
        Schema::create('service_cards', function (Blueprint $table) {
            $table->id();
            $table->string('pickup_point');
            $table->string('destination');
            $table->integer('price');
            $table->string('main_image')->nullable();
            $table->string('secondary_image')->nullable();
            $table->foreignId('service_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('phone_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_cards');
    }
};