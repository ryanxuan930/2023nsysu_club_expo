<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'coupon_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'coupon_code',
        'coupon_context',
        'issued_at',
        'expired_at',
        'valid',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'coupon_context' => 'array',
        'issued_at' => 'datetime',
        'expired_at' => 'datetime',
        'valid' => 'boolean',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'u_id', 'u_id');
    }
}
