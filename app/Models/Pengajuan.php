<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Aroma;
use App\Models\Kemasan;
use App\Models\User;
use App\Models\HargaParfum;
use App\Models\Traking;
use App\Models\Pembayaran;

class Pengajuan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'harga_parfum_id',
        'jenis_parfum',
        'jumlah',
        'target_market',
        'catatan',
        'status',
        'no_pengajuan', // tambahkan jika perlu
        'total_harga', // tambahkan jika perlu
    ];

    /**
     * Relasi ke User (klien)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke HargaParfum
     */
    public function hargaParfum()
    {
        return $this->belongsTo(HargaParfum::class);
    }

    /**
     * Relasi ke Tracking (history status)
     */
    public function trakings()
    {
        return $this->hasMany(Traking::class);
    }

    /**
     * Relasi ke Pembayaran (One to Many)
     * Satu pengajuan bisa memiliki banyak pembayaran (cicilan)
     */
    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'pengajuan_id');
    }

    /**
     * Relasi ke Pembayaran (untuk memudahkan akses pembayaran pertama/terakhir)
     * Bisa digunakan jika ingin mengambil satu pembayaran terbaru
     */
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'pengajuan_id')->latest();
    }

    /**
     * Relasi Many-to-Many ke Aroma
     */
    public function aromas()
    {
        return $this->belongsToMany(Aroma::class, 'pengajuan_aromas')
                    ->withPivot('note_id')
                    ->withTimestamps();
    }

    /**
     * Relasi Many-to-Many ke Kemasan
     */
    public function kemasans()
    {
        return $this->belongsToMany(Kemasan::class, 'pengajuan_kemasans')
                    ->withPivot('aroma_id', 'logo_label')
                    ->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    */

    /**
     * Mendapatkan total pembayaran yang sudah dilakukan
     */
    public function getTotalPembayaranAttribute()
    {
        return $this->pembayarans()->sum('total') ?? 0;
    }

    /**
     * Mendapatkan status pembayaran (Lunas, Angsuran, Belum Bayar)
     */
    public function getStatusPembayaranAttribute()
    {
        if ($this->pembayarans()->count() == 0) {
            return 'Belum Bayar';
        }
        
        $totalBayar = $this->pembayarans()->sum('total');
        
        if ($totalBayar >= ($this->total_harga ?? 0)) {
            return 'Lunas';
        } elseif ($totalBayar > 0) {
            return 'Angsuran';
        } else {
            return 'Belum Bayar';
        }
    }

    /**
     * Mendapatkan warna status pembayaran untuk UI
     */
    public function getStatusPembayaranColorAttribute()
    {
        $colors = [
            'Lunas' => 'bg-emerald-100 text-emerald-600',
            'Angsuran' => 'bg-orange-100 text-orange-600',
            'Belum Bayar' => 'bg-red-100 text-red-600'
        ];

        return $colors[$this->status_pembayaran] ?? 'bg-slate-100 text-slate-600';
    }

    /**
     * Mendapatkan warna status pengajuan untuk UI
     */
    public function getStatusColorAttribute()
    {
        $colors = [
            'Menunggu' => 'bg-yellow-100 text-yellow-600',
            'Pending' => 'bg-orange-100 text-orange-600',
            'Diproses' => 'bg-blue-100 text-blue-600',
            'Proses' => 'bg-blue-100 text-blue-600',
            'Selesai' => 'bg-emerald-100 text-emerald-600',
            'Dibatalkan' => 'bg-red-100 text-red-600',
            'Ditolak' => 'bg-red-100 text-red-600',
            'Batal' => 'bg-red-100 text-red-600',
            'Dalam Pengiriman' => 'bg-purple-100 text-purple-600'
        ];

        return $colors[$this->status] ?? 'bg-slate-100 text-slate-600';
    }

    /**
     * Mendapatkan nomor pengajuan yang terformat
     */
    public function getNoPengajuanFormattedAttribute()
    {
        return $this->no_pengajuan ?? 'PJ-' . str_pad($this->id, 5, '0', STR_PAD_LEFT);
    }

    /**
     * Mendapatkan inisial klien
     */
    public function getClientInitialAttribute()
    {
        if (!$this->user || !$this->user->name) {
            return 'NA';
        }
        
        $words = explode(' ', $this->user->name);
        $initials = '';
        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return substr($initials, 0, 2);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * Scope untuk pengajuan yang sudah selesai
     */
    public function scopeSelesai($query)
    {
        return $query->where('status', 'Selesai');
    }

    /**
     * Scope untuk pengajuan yang dibatalkan/ditolak
     */
    public function scopeBatal($query)
    {
        return $query->whereIn('status', ['Dibatalkan', 'Ditolak', 'Batal']);
    }

    /**
     * Scope untuk pengajuan yang aktif (belum selesai)
     */
    public function scopeAktif($query)
    {
        return $query->whereNotIn('status', ['Selesai', 'Dibatalkan', 'Ditolak', 'Batal']);
    }

    /**
     * Scope untuk pengajuan dalam proses produksi
     */
    public function scopeDalamProduksi($query)
    {
        return $query->whereIn('status', ['Diproses', 'Proses']);
    }

    /**
     * Scope untuk filter berdasarkan rentang tanggal
     */
    public function scopeTanggalRange($query, $start, $end)
    {
        return $query->whereBetween('created_at', [$start, $end]);
    }

    /*
    |--------------------------------------------------------------------------
    | Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Cek apakah pengajuan sudah lunas
     */
    public function isLunas()
    {
        return $this->status_pembayaran === 'Lunas';
    }

    /**
     * Cek apakah pengajuan sudah selesai
     */
    public function isSelesai()
    {
        return $this->status === 'Selesai';
    }

    /**
     * Cek apakah pengajuan dibatalkan
     */
    public function isBatal()
    {
        return in_array($this->status, ['Dibatalkan', 'Ditolak', 'Batal']);
    }

    /**
     * Mendapatkan daftar aroma yang digunakan (format string)
     */
    public function getAromaListAttribute()
    {
        return $this->aromas->pluck('nama_kategori')->implode(', ');
    }

    /**
     * Mendapatkan daftar kemasan yang digunakan (format string)
     */
    public function getKemasanListAttribute()
    {
        return $this->kemasans->map(function($item) {
            return $item->jenis_botol . ' (' . $item->ukuran . ')';
        })->implode(', ');
    }
}