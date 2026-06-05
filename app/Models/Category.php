<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Pinapayagan ang mga column na ito na lagyan ng data
    protected $fillable = [
        'user_id',
        'name',
        'type',
    ];
}