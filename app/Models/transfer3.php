<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class transfer3 extends Model
{
    use HasFactory;

    protected $fillable = [
        'transfer_id',
        'pengirim_id',
        'material_id',
        'penerima_id',
        'material_dokumen',
        'item',
        'pengganti',
        'status',
        'status_pengiriman',
        'diterima_oleh',
        'estimate_time_arrival'
    ];

    public function UserClass(): HasOneThrough
    {
        return $this->hasOneThrough(Transfer::class, User::class);
    }
}
