<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'content_type',
        'content_path',
    ];

    /**
     * Get the embed URL for the course content.
     *
     * @return string
     */
    public function getEmbedUrlAttribute()
    {
        if ($this->content_type === 'video' && str_contains($this->content_path, 'youtube.com/watch?v=')) {
            return str_replace('watch?v=', 'embed/', $this->content_path);
        }
        return $this->content_path;
    }
}
