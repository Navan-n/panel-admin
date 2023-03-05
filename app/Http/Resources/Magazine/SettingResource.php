<?php

namespace App\Http\Resources\Magazine;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
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
            'meta_title'=>$this->meta_title,
            'description'=>$this->description,
            'header_btn'=>$this->header_btn,
            'header_link'=>$this->header_link,
            'area_code'=>$this->area_code,
            'phone_number'=>$this->phone_number,
            'mag_home_desc'=>$this->mag_home_desc,
            'mag_video_desc'=>$this->mag_video_desc
        ];
    }
}
