<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    protected $table = 'tariffs';
    protected $fillable = [
        'ration_name',
        'cooking_day_before',
    ];
}
