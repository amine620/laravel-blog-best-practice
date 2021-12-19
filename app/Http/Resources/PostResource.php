<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'id'=>$this->id,
            'title'=>$this->title,
            'content'=>$this->description,
            'user'=>[
                'id'=>$this->user->id,
                'name' => $this->user->name,
                'photo'=>$this->user->image->path??'no image' ,//method 1
            ]
        ];
    }
}
