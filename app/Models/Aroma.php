<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Aroma extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama_kategori',
        'biaya_kategori'
    ];
}
