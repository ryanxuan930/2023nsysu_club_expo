<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'bulletin_id';

    protected $fillable = [
        'title',
        'content',
        'category',
        'post_a_id',
        'links',
        'views',
    ];

    protected $casts = [
        'content' => 'array',
        'links' => 'array',
    ];
}
