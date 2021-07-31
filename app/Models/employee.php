<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;
    protected $table = "employees";

    public function constant(){
        return $this->belongsTo(constant::class,'status_id');
    }
}
