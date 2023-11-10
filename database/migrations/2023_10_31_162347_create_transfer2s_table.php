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
        Schema::create('transfer2s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transfer_id')->constrained();
            $table->foreignId('pengirim_id')->constrained('plans','id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('material_id')->constrained();
            $table->foreignId('penerima_id')->constrained('plans','id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('material_dokumen');
            $table->integer('item');
            $table->enum('pengganti',['yes','no']);
            $table->enum('status',['open','close']);
            $table->enum('status_pengiriman',['belum','diterima']);
            $table->string('diterima_oleh')->nullable();
            $table->date('estimate_time_arrival')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer2s');
    }
};
