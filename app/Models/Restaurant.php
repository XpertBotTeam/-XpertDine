<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'location',
        'description',
        'phoneNumber',
        'image_path',
        'rating'
    ];
    public function reservations()
    {
        return $this->hasMany(reservation::class);
    }

}
