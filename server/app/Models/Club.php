<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'club_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'club_type',
        'club_code',
        'club_name_ch',
        'club_name_en',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function admins() {
        return $this->hasMany(Admin::class, 'club_code', 'club_code');
    }
}
