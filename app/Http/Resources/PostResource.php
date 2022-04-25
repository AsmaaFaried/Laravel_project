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
        // return parent::toArray($request);

            return [
                'id'=>$this->id,
                'title'=>$this->title,
                'description'=>$this->description,
                'post_creator'=>$this->post_creator,
                'PostImage'=>$this->PostImage,
                'slug'=>$this->slug,
                'user'=>new UserResource($this->user)

            ];
    }
}
