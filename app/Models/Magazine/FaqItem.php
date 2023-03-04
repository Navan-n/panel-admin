<?php

namespace App\Models\Magazine;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqItem extends Model
{
    use HasFactory;
    protected $table = 'mag_faqs_items';

    protected $fillable = [
        'faq_id',
        'title',
        'answer',
        'createdBy',
        'editedBy'
    ];

    public function faqs()
    {
        return $this->belongsTo(Faq::class);
    }
}
