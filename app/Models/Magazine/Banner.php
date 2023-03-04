<?php

namespace App\Models\Magazine;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'mag_banners';


    protected $fillable = [
        'title',
        'alt',
        'code',
        'link',
        'landing_page',
        'row',
        'col',
        'order',
        'status',
        'createdBy',
        'editedBy'
    ];
}
