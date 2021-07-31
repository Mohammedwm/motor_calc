<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class constant extends Model
{
    use HasFactory;

    protected $table = "constants";

    public function constant_main(){
        return $this->belongsTo(constant_main::class,'main_id');
    }
}
