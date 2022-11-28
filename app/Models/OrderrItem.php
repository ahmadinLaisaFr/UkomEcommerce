<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderrItem extends Model
{
    use HasFactory;

    protected $table = 'orderr_items';
    protected $guarded = ['id'];

    public function order()
    {
        return $this->belongsTo(Orderr::class, 'order_id');
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
