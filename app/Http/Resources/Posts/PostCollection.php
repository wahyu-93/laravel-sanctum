<?php

namespace App\Http\Resources\Posts;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => collect($this->collection)->map(function($post){
                return [
                    'id'   => $post->id,
                    'slug' => $post->slug,
                    'name' => $post->name,
                    'body' => $post->body,
                    'author' => $post->user->name,
                    'subject' => $post->subject
                ];
            })
        ];
    }
}
