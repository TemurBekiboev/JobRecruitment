<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VacancyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'salary' => $this->salary,
            'description' => $this->description,
            'job_type' => $this->job_type,
            'status' => $this->status,
            'published_at' => $this->created_at->format('d M, Y'),
        ];
    } 
}
