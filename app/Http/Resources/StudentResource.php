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
        return [
            'id' => $this->id,
            'gender' => $this->gender,
            'name' => $this->name,
            'slug' => $this->slug,
            'email' => $this->email,
            'age' => now()->diffInYears($this->dob) > 1
                ? now()->diffInYears($this->dob) . ' anos'
                : now()->diffInYears($this->dob) . ' ano',
            'birthday' => Carbon::createFromFormat('Y-m-d', $this->dob)->format('d/m/Y'),
            'dob' => $this->when($request->routeIs(['alunos.edit']), $this->dob),
            'genderMessage' => $this->when($request->routeIs(['alunos.show','alunos.edit','alunos.index']), $this->gender === 'm' ? "do aluno $this->name " : "da aluna $this->name"),
            'contact' => $this->when($request->routeIs(['alunos.show','alunos.edit']), $this->contact),
            'address' => $this->when($request->routeIs(['alunos.show','alunos.edit']), $this->address),
            'district' => $this->when($request->routeIs(['alunos.show','alunos.edit']), $this->district),
            'city' => $this->when($request->routeIs(['alunos.show','alunos.edit']), $this->city),
            'zipcode' => $this->when($request->routeIs(['alunos.show','alunos.edit']), $this->zipcode)
        ];
    }
}
