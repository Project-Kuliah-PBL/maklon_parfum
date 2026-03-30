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
        Schema::table('pengajuans', function (Blueprint $table) {

            $table->decimal('total_harga',15,2)
            ->after('catatan')
            ->nullable();

            $table->date('estimasi_selesai')
            ->after('total_harga')
            ->nullable();
            

        });
    }

    public function down(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {

            $table->dropColumn('total_harga');
            $table->dropColumn('estimasi_selesai');

        });
    }
};
