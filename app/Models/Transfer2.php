<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer2 extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transfer_id',
        'pengirim_id',
        'material_id',
        'penerima_id',
        'material_dokumen',
        'item',
        'pengganti',
        'status',
        'status_pengiriman',
        'diterima_oleh'
    ];
}
