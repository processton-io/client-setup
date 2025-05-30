<?php

namespace Processton\Campaigns\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'timeline',
    ];

    protected $casts = [
        'timeline' => 'array',
        'start_date' => 'datetime',
    ];
}
