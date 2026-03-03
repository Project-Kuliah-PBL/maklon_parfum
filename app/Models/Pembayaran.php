<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'pengajuan_id',
        'metode_pembayaran',
        'total',
        'tanggal_pembayaran',
        'status_bayar'
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'tanggal_pembayaran' => 'date',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function isPaid()
    {
        return $this->status_bayar === 'paid';
    }
}
