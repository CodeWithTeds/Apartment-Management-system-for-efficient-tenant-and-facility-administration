<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'unit_number',
        'unit_type',
        'availability',
        'rent_price',
        'description',
        'admin_id',
    ];

    /**
     * Get the admin that owns the unit.
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}