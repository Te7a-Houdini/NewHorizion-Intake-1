<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Storage;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'product_name' => $this->name,
            'category_id' => $this->category_id,
            'slug' => $this->slug,
            'image' => config('app.url') .Storage::url($this->image)
        ];
    }
}
