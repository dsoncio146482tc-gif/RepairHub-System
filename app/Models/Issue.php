<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = [
        'location', 'description', 'photo', 'priority', 'id_number', 'status', 'user_id'
    ];

    protected $casts = [
        'photo' => 'array',
    ];

    public function images()
    {
        return $this->hasMany(IssueImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getOverallPriority()
    {
        $priorities = $this->images()->pluck('priority')->toArray();

        if (in_array('high', $priorities)) {
            return 'high';
        } elseif (in_array('medium', $priorities)) {
            return 'medium';
        } else {
            return 'low';
        }
    }
}