<?php

namespace App\Models\Magazine;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Magazine\Post;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'mag_comments';

    protected $fillable = [
        'post_id',
        'customer_id',
        'name',
        'email',
        'body',
        'like',
        'dislike',
        'is_answer',
        'status',
        'createdBy',
        'editedBy'
    ];
    public function post(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
