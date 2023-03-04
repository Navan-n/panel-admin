<?php

namespace App\Models\Magazine;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Magazine\FaqItem;

class Faq extends Model
{
    use HasFactory;
    protected $table = 'mag_faqs';
    protected $fillable = [
        'title',
        'slug',
        'createdBy',
        'editedBy'
    ];

    public function faqsItem()
    {
        return $this->hasMany(FaqItem::class);
    }
}
