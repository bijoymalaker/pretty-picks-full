<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'author',
        'is_published',
        'meta_title',
        'meta_description',
        'tags',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    /**
     * Accessor for featured image URL
     */
    protected function featuredImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->featured_image 
                ? asset('storage/' . $this->featured_image) 
                : asset('images/placeholder-blog.jpg'),
        );
    }

    /**
     * Scope for published blogs
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope for latest blogs
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
