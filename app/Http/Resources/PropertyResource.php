<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->getRouteKey(),
            'uuid' => $this->uuid,
            'county' => $this->county,
            'country' => $this->country,
            'town' => $this->town,
            'description' => $this->description,
            'address' => $this->address,
            'image_full' => $this->image_full,
            'image_thumbnail' => $this->image_thumbnail,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'num_bedrooms' => $this->num_bedrooms,
            'num_bathrooms' => $this->num_bathrooms,
            'price' => $this->price,
            'type' => $this->type,
        ];
    }
}
