<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSystem extends Model
{
    use HasFactory;
    protected $dates = ['created_at', 'updated_at'];
    public $timestamps = true;
    protected $casts = [
        'item_details' => 'array',

    ];
}
