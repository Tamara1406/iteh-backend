<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'document';

    public function toArray($request)
    {
        return[
            'id'=>$this->resource->id,
            'naziv'=>$this->resource->naziv,
            'sadrzaj'=>$this->resource->sadrzaj,
            'brojStrana'=>$this->resource->brojStrana,
            'typeDocument'=>$this->resource->typedocument,
            'autor'=>$this->resource->autor,
            'sistemUpravljanja'=>$this->resource->sistemupravljanja
        ];
    }
}
