<?php

namespace App\Http\Resources;

use App\Models\Tag;
use Illuminate\Http\Resources\Json\JsonResource;

class WallpaperResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $tags = $this->tags;

        return [
            'id' => $this->id,
            'url' => ($this->url),
            'title' => $this->title,
            'tags' => $this->tags,
            'likes' => $this->likes,
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }
}
