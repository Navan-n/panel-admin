<?php

namespace App\Models\Magazine;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $table = 'mag_sliders';

    protected $fillable = [
        'title',
        'alt',
        'link',
        'position',
        'createdBy',
        'editedBy'
    ];
}
