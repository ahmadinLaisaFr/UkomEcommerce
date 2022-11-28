<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $table = 'shippings';
    protected $guarded = ['id'];

    public function order()
    {
        return $this->belongsTo(Orderr::class, 'order_id');
    }

    public function expedition()
    {
        return $this->belongsTo(Expedition::class);
    }
}
