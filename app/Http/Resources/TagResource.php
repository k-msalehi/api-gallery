<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $image = ($this->wallpapers->first() !== null) ? $this->wallpapers->first()->url : null;
        return [
            'id' => $this->id,
            'slug' => ($this->slug),
            'title' => $this->title,
            'image' => $image,
        ];
    }
}
