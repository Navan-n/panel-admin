<?php

namespace App\Models\Magazine;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    protected $table = 'mag_posts';

    protected $fillable = [
        'title',
        'meta_title',
        'meta_desc',
        'abstracted',
        'body',
        'slug',
        'source',
        'source_link',
        'chief_select',
        'embed',
        'alt',
        'type',
        'createdBy',
        'editedBy'
    ];

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'mag_posts_categories', 'post_id', 'category_id');
    }
    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'mag_posts_tags', 'post_id', 'tag_id');
    }
}
