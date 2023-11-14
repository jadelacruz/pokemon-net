<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PokemonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this['id'],
            'name'    => $this['name'],
            'weight'  => $this['weight'],
            'height'  => $this['height'],
            'sprites' => json_decode($this['pokemon_v2_pokemonsprites'][0]['sprites'], true)
        ];
    }
}
