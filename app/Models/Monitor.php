<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['cart_id', 'is_done'];

    public function cart(){
        return $this->belongsTo(Cart::class);
    }


   
}
