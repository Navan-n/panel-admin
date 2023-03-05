<?php

namespace App\Http\Resources\Shop;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleCategoryResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'off' => $this->off,
            'createdBy' => $this->createdBy,
            'editedBy' => $this->editedBy,
        ];
    }
}
