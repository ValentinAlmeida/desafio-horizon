<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SurfistaResource extends JsonResource
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
            'numero' => $this->numero,
            'nome' => $this->nome,
            'pais' => $this->pais,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'baterias' => BateriaResource::collection($this->whenLoaded('baterias')),
            'ondas' => OndaResource::collection($this->whenLoaded('ondas')),
        ];
    }
}
