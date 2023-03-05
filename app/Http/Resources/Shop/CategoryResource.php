<?php

namespace App\Http\Resources\Shop;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'parent_id'=>$this->parent_id,
            'meta_title'=>$this->meta_title,
            'slug'=>$this->slug,
            'order'=>$this->order,
            'new'=>$this->new,
            'description'=>$this->description,
            'meta_desc'=>$this->meta_desc,
            'alt'=>$this->alt,
            'pic_title'=>$this->pic_title,
            'off'=>$this->off,
            'createdBy'=>$this->createdBy,
            'editedBy'=>$this->editedBy,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
