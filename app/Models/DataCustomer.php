<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class DataCustomer extends Model
{
    use HasFactory;

    protected $table = 'data_customers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'nama',
        'nomor_hp',
        'alamat',
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
