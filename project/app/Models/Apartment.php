<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'name',
        'address',
        'total_units',
        'available_units',
        'capacity',
        'rent_type',
        'pet_policy',
        'description',
        'image',
        'status',
        'location',
        'price',
        'property_type',
        'amenities',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
