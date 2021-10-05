<?php

namespace Modules\Disease\Transformers;

use Modules\Symptom\Transformers\SymptomResource;
use Modules\DiseaseClassification\Transformers\DiseaseClassificationResource;
use Modules\DiseaseCategory\Transformers\DiseaseCategoryResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiseaseResource extends JsonResource
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
            'name' => $this->name,
            'content' => $this->content,
            'doctor_id' => $this->doctor_id,
            'age_start' => $this->age_start,
            'age_end' => $this->age_end,
            'prevelance_rate' => $this->prevelance_rate,
            'symptoms' => SymptomResource::collection($this->symptoms),
            'classifications' => DiseaseClassificationResource::collection($this->diseaseClassification),
            'categories' => DiseaseCategoryResource::collection($this->diseaseCategory),
        ];
    }
}