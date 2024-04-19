<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GeneralCollection extends ResourceCollection
{
    public $resourceClass;
    function __construct($resource,$resourceClass)
    {
        parent::__construct($resource);
        $this->resourceClass = $resourceClass;
    }
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $resourceClass = $this->resourceClass;
        $data['data'] = $this->collection->transform(function ($q)use($resourceClass){
            return new $resourceClass($q);
        });

        if ($this->resource instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            $data['pagination'] = [
                'current_page' => $this->resource->currentPage(),
                'last_page' => $this->resource->lastPage(),
                'total' => $this->resource->total(),
                'per_page' => $this->resource->perPage(),
                'next_page'=>$this->resource->nextPageUrl(),
                'prev_page'=>$this->resource->previousPageUrl()
            ];
        }
        return $data;
    }
}
