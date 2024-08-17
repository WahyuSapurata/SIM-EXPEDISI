<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Penawaran extends Model
{
    use HasFactory;

    protected $table = 'penawarans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'nama_costumer',
        'alamat',
        'no_surat',
        'perihal',
        'jenis_barang',
        'jumlah',
        'kondisi',
        'lokasi_muat',
        'lokasi_tujuan',
        'harga',
        'pembayaran',
        'lokasi',
        'tanggal',
    ];

    protected static function boot()
    {
        parent::boot();

        // Event listener untuk membuat UUID sebelum menyimpan
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }
}
