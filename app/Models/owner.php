<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class owner extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'email',
        'passowrd'
    ];
    public function Restaurants(){
        return $this->hasone(restaurant::class);
    }
}
