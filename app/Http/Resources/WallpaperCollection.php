<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class WallpaperCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'wallpapers' => $this->collection,
            'pagination' => [
                'next' => $this->nextPageUrl(),
                'prev' => $this->previousPageUrl(),
                'per_page' => $this->perPage(),
                'has_more' => $this->hasMorePages(),
            ],
        ];
    }
}
