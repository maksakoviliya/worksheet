<?php

namespace App\Http\Resources;

use App\Worksheet;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WorksheetCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => WorksheetResource::collection($this->collection),
            'links' => [
                'next_page_url' => $this->nextPageUrl(),
                'prev_page_url' => $this->previousPageUrl()
            ],
        ];

    }
}
