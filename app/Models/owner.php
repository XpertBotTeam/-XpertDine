<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class owner extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $fillable=[
        'name',
        'email',
        'password'
    ];
    public function Restaurants()
    {
       return $this->hasone(restaurant::class);
    }
}
