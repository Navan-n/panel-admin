<?php

namespace App\Http\Resources\Magazine;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'meta_title'=>$this->meta_title,
            'meta_desc'=>$this->meta_desc,
            'abstracted'=>$this->abstracted,
            'body'=>$this->body,
            'slug'=>$this->slug,
            'published'=>$this->published,
            'source'=>$this->source,
            'source_link'=>$this->source_link,
            'chief_select'=>$this->chief_select,
            'embed'=>$this->embed,
            'alt'=>$this->alt,
            'type'=>$this->type,
            'createdBy'=>$this->createdBy,
            'editedBy'=>$this->editedBy,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
