<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'client_name',
        'client_phone',
        'tariff_id',
        'schedule_type',
        'comment',
        'first_date',
        'last_date',
    ];

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }
    public function tariff()
    {
        return $this->belongsTo(Tariff::class);
    }
}
