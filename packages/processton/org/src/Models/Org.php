<?php

namespace Processton\Org\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Org extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'group',
        'title',
        'description',
        'org_key',
        'org_value',
        'org_options'
    ];

    protected $casts = [
        'org_options' => 'array',
    ];

}
