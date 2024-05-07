<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestHouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'Facilities',
        'images',
        'prices',
        'location', 
        'Phonenumber',
        'city',
        'status'
    ];


   protected $casts=[
        'Facilities'=>'array',
        'images'=>'array'
    ];
}
              