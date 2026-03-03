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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('harga_parfum_id')->constrained()->cascadeOnDelete();

            $table->string('jenis_parfum');
            $table->integer('jumlah');
            $table->string('target_market')->nullable();
            $table->text('catatan')->nullable();

            $table->enum('status', ['pending','proses','selesai','ditolak'])->default('pending');

            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
