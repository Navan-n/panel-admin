<?php

namespace App\Http\Resources\Magazine;

use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
          'id'=>$this->id,
          'title'=>$this->title,
          'slug'=>$this->slug,
          'body'=>$this->body,

          'created_at' => $this->created_at->format('d/m/Y'),
          'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
