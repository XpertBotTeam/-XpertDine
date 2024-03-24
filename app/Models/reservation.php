<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'restaurant_id',
        'reservation_time',
        'number_of_people'
    ];


}
