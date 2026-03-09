<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengajuan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    'user_id',
    'harga_parfum_id',
    'jenis_parfum',
    'jumlah',
    'target_market',
    'catatan',
    'status',
    'total_harga',
    'estimasi_selesai'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION USER
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATION HARGA PARFUM
    |--------------------------------------------------------------------------
    */

    public function hargaParfum()
    {
        return $this->belongsTo(HargaParfum::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATION TRACKING PRODUKSI
    |--------------------------------------------------------------------------
    */

    public function tracking()
    {
        return $this->hasMany(Traking::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATION PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATION AROMA (Many to Many)
    |--------------------------------------------------------------------------
    */

    public function aromas()
    {
        return $this->belongsToMany(Aroma::class, 'pengajuan_aromas')
                    ->withPivot('note_id')
                    ->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | RELATION KEMASAN (Many to Many)
    |--------------------------------------------------------------------------
    */

    public function kemasans()
    {
        return $this->belongsToMany(Kemasan::class, 'pengajuan_kemasans')
                    ->withPivot('aroma_id','logo_label')
                    ->withTimestamps();
    }
}