<?php

namespace Modules\DiseaseClassification\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiseaseClassificationResource extends JsonResource
{
    /**
     * Transform resource into an array
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name
        ];
    }
}