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
        Schema::create('kemasans', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_botol');
            $table->string('ukuran');
            $table->string('jenis_box')->nullable();
            $table->text('catatan')->nullable();
            $table->decimal('biaya_kemasan', 15,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kemasans');
    }
};
