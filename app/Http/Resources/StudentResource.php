<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'email' => $this->email,
            'age' => now()->diffInYears($this->dob) > 1
                ? now()->diffInYears($this->dob) . ' anos'
                : now()->diffInYears($this->dob) . ' ano',
            'birthday' => Carbon::createFromFormat('Y-m-d', $this->dob)->format('d/m/Y'),
            'dob' => $this->when($request->routeIs(['estudantes.edit']), $this->dob),
            'contact' => $this->when($request->routeIs(['estudantes.show','estudantes.edit']), $this->contact),
            'address' => $this->when($request->routeIs(['estudantes.show','estudantes.edit']), $this->address),
            'district' => $this->when($request->routeIs(['estudantes.show','estudantes.edit']), $this->district),
            'city' => $this->when($request->routeIs(['estudantes.show','estudantes.edit']), $this->city),
            'zipcode' => $this->when($request->routeIs(['estudantes.show','estudantes.edit']), $this->zipcode)
        ];
    }
}
