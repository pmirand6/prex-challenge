<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class AuditTrail extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'url',
        'request_body',
        'response',
        'client_ip_address',
        'user_id',
    ];
}
