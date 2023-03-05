<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftOffers extends Model
{
    use HasFactory;

    protected $table = 'gift_offers';

    protected $fillable = [
        'title',
        'pic',
        'alt',
        'createdBy',
        'editedBy'
    ];
}
