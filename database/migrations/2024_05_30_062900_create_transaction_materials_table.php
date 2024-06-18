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
        Schema::create('transaction_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_id');
            $table->foreignId('to_id');
            $table->string('type');
            $table->string('reservation_number');
            $table->string('gi_number');
            $table->string('rfc_number');
            $table->string('order')->nullable();
            $table->string('inet')->nullable();
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
        Schema::dropIfExists('transaction_materials');
    }
};
