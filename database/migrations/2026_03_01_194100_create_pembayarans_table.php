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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained()->cascadeOnDelete();

            $table->string('metode_pembayaran');
            $table->decimal('total', 18,2);
            $table->date('tanggal_pembayaran');
            $table->enum('status_bayar', ['unpaid','paid','failed'])->default('unpaid');

            $table->timestamps();

            $table->index('status_bayar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
