<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'title',
        'parent_id',
        'meta_title',
        'slug',
        'order',
        'new',
        'description',
        'meta_desc',
        'alt',
        'pic_title',
        'off',
        'createdBy',
        'editedBy'
    ];

    public function subcategory()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
