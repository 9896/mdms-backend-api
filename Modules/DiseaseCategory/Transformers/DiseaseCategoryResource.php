<?php

namespace Modules\DiseaseCategory\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiseaseCategoryResource extends JsonResource
{
    /**
     * Transform resource into an array
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return $this->resource ? [
            'uuid' => $this->uuid,
            'name' => $this->name
        ] : [];
    }
}