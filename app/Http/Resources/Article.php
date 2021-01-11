<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
//use Illuminate\Http\Resources\Json\ResourceCollection;



class Article extends JsonResource 
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
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'author' => $this->author,
     
        ];
    }

    // public function with($request)
    // {
    //     return [
    //         'version' => '1.0.0',
    //         'owner' => 'Can Şık'
    //     ];
    // }
}
