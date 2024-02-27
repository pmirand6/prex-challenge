<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class UserGifs extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'gif_id',
        'alias'
    ];
}
