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
        'number_of_people',
        'phone_number'
    ];

    public function users()
    {
        return $this->belongsTo(user::class);
    }
    public function restaurants(){
        return $this->belongsTo(Restaurant::class);
    }
}
