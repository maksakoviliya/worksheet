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
        $credits_total = collect($this->creditors)->pluck('total');
        $credits_monthly = collect($this->creditors)->pluck('monthly');
        return [
            'id' => $this->id,
            'envyID' => $this->envyID,
            'filial' => $this->filial ? $this->filial['name'] : '',
            'credits_total' => $credits_total ,
            'credits_monthly' => $credits_monthly ,
            'created_at' => $this->created_at->format('d.m.Y'),
            'user' => new UserResource($this->user),
        ];
    }
}
