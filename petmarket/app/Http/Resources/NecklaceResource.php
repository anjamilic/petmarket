<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NecklaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap ="necklace"; //ovo predstavlja naziv objekta
    public function toArray($request)
    {
        return [
            'id'=>$this->resource->id,
            'item'=>$this->resource->item,
            'material'=>$this->resource->material,
            'pet'=>new PetResource($this->resource->pet),
        ];
    }
}
