<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
    use HasFactory;
    protected $primaryKey = 'broadcast_id';
    protected $fillable =  [
        'title',
        'content',
        'expired_at',
    ];
    protected $casts = [
        'expired_at' => 'datetime',
    ];
}
