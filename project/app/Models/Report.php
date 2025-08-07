<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_name',
        'report_type',
        'date_range',
        'start_date',
        'end_date',
        'description',
        'format',
        'status',
        'file_path',
        'completed_at',
        'assignable_id',
        'assignable_type',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function assignable()
    {
        return $this->morphTo();
    }
}
