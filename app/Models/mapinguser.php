<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mapinguser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_id',
    ];

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function plan(){
        return $this->belongsTo(plan::class,'plan_id','id');
    }
}
