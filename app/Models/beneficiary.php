<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class beneficiary extends Model
{
    use HasFactory;

    protected $table = "beneficiaries";

    public function scopePriceKilo($query,$beneficiary_id)
    {
        return $query->where('id',$beneficiary_id);
    }

    public function constant_type(){
        return $this->belongsTo(constant::class,'type_id');
    }

    public function constant_status(){
        return $this->belongsTo(constant::class,'status_id');
    }
}
