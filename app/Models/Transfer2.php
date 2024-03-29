<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Transfer2 extends Model
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
        'estimate_time_arrival',
        'material_update',
        'parent_id',
        'lokasi_transit',
        'nama_pengirim',
        'pr_pengganti',
        'matdoc_pengganti'
    ];

    public function UserClass(): HasOneThrough
    {
        return $this->hasOneThrough(Transfer::class, User::class);
    }

    public function parent(){
        return $this->belongsTo(self::class,'parent_id');
    }

    public function children(){
        return $this->hasMany(self::class, 'parent_id');
    }
}
