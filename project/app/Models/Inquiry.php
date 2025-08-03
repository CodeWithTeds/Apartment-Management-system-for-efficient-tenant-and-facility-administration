<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartment_id',
        'full_name',
        'email',
        'mobile_no',
        'stay_type',
        'nights',
        'occupants',
        'message',
        'status',
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}