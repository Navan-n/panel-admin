<?php

namespace App\Models\Magazine;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = 'mag_pages';

    protected $fillable = [
       'title',
       'slug',
       'body',
       'createdBy',
        'editedBy'
    ];
}
