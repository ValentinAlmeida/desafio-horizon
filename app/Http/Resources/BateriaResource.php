<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BateriaResource extends JsonResource
{
    /**
     * Transforma a BateriaResource em um array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'surfista1' => $this->surfista1,
            'surfista2' => $this->surfista2,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
