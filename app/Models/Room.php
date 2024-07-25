<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    // protected $guarded = ['id'];
    protected $fillable = [
        'name', 'location', 'capacity', 'rate','type', 'facility', 'image'
    ];

    // Mengkast field facility menjadi array
    // protected $casts = [
    //     'facility' => 'array',
    // ];

}
