<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class RealCost extends Model
{
    use HasFactory;

    protected $table = 'real_costs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'uuid_customer',
        'tanggal',
        'nama_kapal',
        'alamat_pengirim',
        'alamat_tujuan',
        'jenis_muatan',
        'qty',
        'satuan',
        'harga',
        'no_invoice',
        'muat',
        'bongkar',
        'terbayarkan',
        'delevery',
    ];

    protected $casts = [
        'jenis_muatan' => 'array',
        'qty' => 'array',
        'satuan' => 'array',
        'harga' => 'array',
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
