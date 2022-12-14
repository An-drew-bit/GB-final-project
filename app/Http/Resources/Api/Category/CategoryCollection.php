<?php

namespace App\Http\Resources\Api\Category;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'categories' => $this->collection
        ];
    }
}
