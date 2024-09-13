<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function cart(){
        return $this->belongsTo(Cart::class);
    }
}
