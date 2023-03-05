<?php

namespace App\Http\Resources\Shop;

use Illuminate\Http\Resources\Json\JsonResource;

class GiftOfferResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'pic' => $this->pic,
            'alt' => $this->alt,
            'createdBy' => $this->createdBy,
            'editedBy' => $this->editedBy,
        ];
    }
}
