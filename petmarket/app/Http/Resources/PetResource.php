<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap ="pet"; 
    public function toArray($request)
    {
       // return parent::toArray($request);
       
        return [
            'id'=>$this->resource->id,
            'species'=>$this->resource->species,
            'breed'=>$this->resource->breed,
            'nickname'=>$this->resource->nickname,
            'user'=>new UserResource($this->resource->user),
        ];
    }
}
