<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'images',
        'Description',
        'Location',
        'PhoneNumber',
        'status',
        'city'
    ];
    protected $casts=[
        'images'=>'array'
    ];
}
