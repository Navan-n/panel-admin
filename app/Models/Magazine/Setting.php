<?php

namespace App\Models\Magazine;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'mag_setting';

    protected $fillable = [
        'title',
        'meta_title',
        'description',
        'header_btn',
        'header_link',
        'area_code',
        'phone_number',
        'mag_home_desc',
        'mag_video_desc',
    ];
}
