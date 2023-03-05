<?php

namespace App\Http\Resources\Magazine;

use Illuminate\Http\Resources\Json\JsonResource;

class PostCommentResource extends JsonResource
{

    public function toArray($request)
    {
        return [
        'id'=>$this->id,
        'post_id'=>$this->post_id,
        'customer_id'=>$this->customer_id,
        'name'=>$this->name,
        'email'=>$this->email,
        'body'=>$this->body,
        'like'=>$this->like,
        'dislike'=>$this->dislike,
        'is_answer'=>$this->is_answer,
        'status'=>$this->status,
        'createdBy'=>$this->createdBy,
        'editedBy'=>$this->editedBy,
        'created_at' => $this->created_at->format('d/m/Y'),
        'updated_at' => $this->updated_at->format('d/m/Y'),
    ];
    }
}
