<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorksheetResource extends JsonResource
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
            'envyID' => $this->envyID,
            'filial' => $this->filial,
            'created_at' => $this->created_at->format('d.m.Y'),
            'user' => new UserResource($this->user),
        ];
    }
}
