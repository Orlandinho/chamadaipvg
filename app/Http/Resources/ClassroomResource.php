<?php

namespace App\Http\Resources;

use App\Enums\ClassroomColors;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'color' => $this->when($request->routeIs(['classes.edit']), $this->color),
            'textColor' => $this->when($request->routeIs(['classes.index']), ClassroomColors::tryFrom($this->color)->textColor()),
            'borderColor' => $this->when($request->routeIs(['classes.index']), ClassroomColors::tryFrom($this->color)->borderColor()),
            'slug' => $this->slug,
            'students_count' => $this->when($request->routeIs(['classes.index']), $this->whenCounted('students')),
            'students' => $this->when($request->routeIs(['classes.show']), $this->whenLoaded('students'))
        ];
    }
}
