<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AgentResource extends JsonResource
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
            'name' => $this->name,
            'properties' => $this->properties->pluck('town')->join(', '),
            'total_price' => (float) number_format($this->properties->sum('price') / 100, 2, '.', ''),
        ];
    }
}
