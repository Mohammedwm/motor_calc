<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reading extends Model
{
    use HasFactory;
    public function scopePreviousReading($query,$month,$beneficiary_id)
    {
        return $query->where('month',$month)->where('beneficiaries_id',$beneficiary_id)->first()->current_reading;
    }
    public function beneficiary(){
        return $this->belongsTo(beneficiary::class,'beneficiaries_id');
    }
    public function employee(){
        return $this->belongsTo(employee::class,'reader_employee_id');
    }


}
