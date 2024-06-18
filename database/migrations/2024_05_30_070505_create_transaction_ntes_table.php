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
        Schema::create('transaction_ntes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nte_id');
            $table->foreignId('from_id');
            $table->foreignId('to_id');
            $table->string('number');
            $table->string('type');
            $table->string('order')->nullable();
            $table->string('inet')->nullable();
            $table->string('item_damage')->nullable();
            $table->string('berita_acara')->default('nok');
            $table->date('date');
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transcation_ntes');
    }
};
