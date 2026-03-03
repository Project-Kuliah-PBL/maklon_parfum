<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Aroma;
use App\Models\Note;
use App\Models\Kemasan;
use App\Models\HargaParfum;
use App\Models\Pengajuan;
use App\Models\Pembayaran;
use App\Models\Traking;

class DatabaseSeeder extends Seeder
{
    // public function run(): void
    // {
    //     $users = User::factory(20)->create();
    //     $aromas = Aroma::factory(5)->create();
    //     $notes = Note::factory(10)->create();
    //     $kemasans = Kemasan::factory(5)->create();
    //     $harga = HargaParfum::factory(3)->create();

    //     Pengajuan::factory(100)->make()->each(function ($pengajuan) use ($users,$harga,$aromas,$notes,$kemasans) {

    //         $pengajuan->user_id = $users->random()->id;
    //         $pengajuan->harga_parfum_id = $harga->random()->id;
    //         $pengajuan->save();

    //         foreach ($aromas->random(2) as $aroma) {
    //             $pengajuan->aromas()->attach($aroma->id, [
    //                 'note_id' => $notes->random()->id
    //             ]);
    //         }

    //         $pengajuan->kemasans()->attach(
    //             $kemasans->random()->id,
    //             ['aroma_id' => $aromas->random()->id, 'logo_label' => 'Default Logo']
    //         );

    //         Pembayaran::factory()->create([
    //             'pengajuan_id' => $pengajuan->id
    //         ]);

    //         Traking::factory()->create([
    //             'pengajuan_id' => $pengajuan->id
    //         ]);
    //     });
    // }
    public function run(): void
{
    // =============================
    // MASTER HARGA PARFUM
    // =============================

    HargaParfum::insert([
        ['jenis_parfum' => 'EDC', 'harga_per_ml' => 1200, 'created_at'=>now(), 'updated_at'=>now()],
        ['jenis_parfum' => 'EDT', 'harga_per_ml' => 2000, 'created_at'=>now(), 'updated_at'=>now()],
        ['jenis_parfum' => 'EDP', 'harga_per_ml' => 3500, 'created_at'=>now(), 'updated_at'=>now()],
        ['jenis_parfum' => 'Extrait', 'harga_per_ml' => 5000, 'created_at'=>now(), 'updated_at'=>now()],
        ['jenis_parfum' => 'Parfum', 'harga_per_ml' => 6500, 'created_at'=>now(), 'updated_at'=>now()],
    ]);

    $hargaParfums = HargaParfum::all();

    // =============================
    // MASTER DATA LAIN
    // =============================

    $users = User::factory(20)->create();
    $aromas = Aroma::factory(5)->create();
    $notes = Note::factory(10)->create();
    $kemasans = Kemasan::factory(5)->create();

    // =============================
    // BUAT 100 PENGAJUAN
    // =============================

    for ($i = 0; $i < 100; $i++) {

        $user = $users->random();
        $harga = $hargaParfums->random();
        $aroma = $aromas->random();
        $note = $notes->random();
        $kemasan = $kemasans->random();

        $jumlah = rand(50, 500);

        $pengajuan = Pengajuan::create([
            'user_id' => $user->id,
            'harga_parfum_id' => $harga->id,
            'jenis_parfum' => $harga->jenis_parfum,
            'jumlah' => $jumlah,
            'target_market' => fake()->randomElement(['Remaja','Dewasa','Premium','Umum']),
            'catatan' => fake()->sentence(),
            'status' => fake()->randomElement(['pending','proses','selesai','ditolak']),
        ]);

        // =============================
        // RELASI AROMA + NOTE
        // =============================

        $pengajuan->aromas()->attach($aroma->id, [
            'note_id' => $note->id
        ]);

        // =============================
        // RELASI KEMASAN
        // =============================

        $pengajuan->kemasans()->attach(
            $kemasan->id,
            [
                'aroma_id' => $aroma->id,
                'logo_label' => 'Default Logo'
            ]
        );

        // =============================
        // HITUNG TOTAL
        // =============================

        $hargaParfumTotal = $harga->harga_per_ml * $jumlah;
        $biayaAroma = $aroma->biaya_kategori;
        $biayaNote = $note->biaya_note;
        $biayaKemasan = $kemasan->biaya_kemasan;

        $total = $hargaParfumTotal + $biayaAroma + $biayaNote + $biayaKemasan;

        // =============================
        // PEMBAYARAN
        // =============================

        $statusBayar = fake()->randomElement(['unpaid','paid','failed']);

        Pembayaran::create([
            'pengajuan_id' => $pengajuan->id,
            'metode_pembayaran' => fake()->randomElement(['Transfer BCA','Transfer Mandiri','QRIS','COD']),
            'total' => $total,
            'tanggal_pembayaran' => now(),
            'status_bayar' => $statusBayar,
        ]);

        // =============================
        // TRACKING
        // =============================

        Traking::create([
            'pengajuan_id' => $pengajuan->id,
            'tahapan' => 'Produksi',
            'catatan' => 'Sedang diproses di pabrik',
            'status' => fake()->randomElement(['progress','done']),
            'tanggal' => now(),
        ]);
    }
}
}
