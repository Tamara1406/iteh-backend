<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SistemUpravljanjaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'sistemupravljanja';

    public function toArray($request)
    {
        return[
            'id'=>$this->resource->id,
            'operativniSistem'=>$this->resource->operativniSistem,
            'maxDokumenata'=>$this->resource->maxDokumenata,
            'brzinaUcitavanja'=>$this->resource->brzinaUcitavanja
        ];
    }
}
