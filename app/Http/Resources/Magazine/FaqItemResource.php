<?php

namespace App\Http\Resources\Magazine;

use Illuminate\Http\Resources\Json\JsonResource;

class FaqItemResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'faq_id'=>$this->faq_id,
            'title'=>$this->title,
            'answer'=>$this->answer,
            'createdBy'=>$this->createdBy,
            'editedBy'=>$this->editedBy,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
