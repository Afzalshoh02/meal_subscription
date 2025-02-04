<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $table = 'meals';

    protected $fillable = [
        'order_id',
        'cooking_date',
        'delivery_date',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
