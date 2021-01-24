<?php

namespace Crud\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProdutoCollection extends ResourceCollection
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
            'data' => $this->collection, 
            'total' => [
                'registros' => $this->collection->count(), 
                'valor' => $this->collection->sum('valor')
            ]
        ];
    }
}
