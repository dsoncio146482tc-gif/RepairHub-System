<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssueImage extends Model
{
    protected $fillable = [
        'issue_id',
        'photo_path',
        'priority',
        'analysis_notes',
    ];

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }
}
