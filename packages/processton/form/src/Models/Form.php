<?php

namespace Processton\Form\Models;

use Illuminate\Database\Eloquent\Model;
use Processton\Campaigns\Models\Campaign;

class Form extends Model
{
    protected $fillable = [
        'name',
        'campaign_id',
        'is_published',
        'slug',
        'schema', // JSON structure for rows/elements
    ];

    protected $casts = [
        'schema' => 'array',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }
}
