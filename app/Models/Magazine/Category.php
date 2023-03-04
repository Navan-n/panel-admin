<?php

namespace App\Models\Magazine;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Magazine\Post;

class Category extends Model
{
    use HasFactory;

    protected $table = 'mag_categories' ;

    protected $fillable = [
        'title',
        'slug',
        'order',
        'status',
        'meta_desc',
        'meta_title',
        'description',
        'parent_id',
        'createdBy',
        'editedBy'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'mag_posts_category', 'category_id', 'post_id');
    }

    public function subcategory()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
