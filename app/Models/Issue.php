<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = [
        'location', 'description', 'photo', 'priority', 'id_number', 'status'
    ];

    protected $casts = [
        'photo' => 'array',
    ];

    public function images()
    {
        return $this->hasMany(IssueImage::class);
    }

    /**
     * Get the overall priority based on attached images
     * Returns the highest priority among all images
     */
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