<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OndaResource extends JsonResource
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
            'id' => $this->id,
            'bateria_id' => $this->bateria_id,
            'surfista_id' => $this->surfista_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'bateria' => new BateriaResource($this->whenLoaded('bateria')),
            'surfista' => new SurfistaResource($this->whenLoaded('surfista')),
            'nota' => new NotaResource($this->whenLoaded('nota')),
        ];
    }
}
