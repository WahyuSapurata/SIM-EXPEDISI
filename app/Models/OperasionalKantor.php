<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class OperasionalKantor extends Model
{
    use HasFactory;

    protected $table = 'operasional_kantors';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'kategori',
        'tanggal',
        'item',
        'qty',
        'satuan',
        'harga',
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
