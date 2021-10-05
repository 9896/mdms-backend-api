<?php

namespace Modules\Admin\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * 
     * @param Request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            "uuid" => $this->uuid,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "email" => $this->email,
            
        ];
    }
}