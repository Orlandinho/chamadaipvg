<?php

namespace App\Http\Resources;

use App\Models\Classroom;
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
            'classroom' => $this->whenLoaded('classroom'),
            'classrooms' => $this->when($request->routeIs(['alunos.edit']), Classroom::select('id','name')->get()),
            'name' => $this->name,
            'slug' => $this->when($request->routeIs(['alunos.index','classes.show']), $this->slug),
            'email' => $this->email,
            'age' => now()->diffInYears($this->dob) > 1
                ? now()->diffInYears($this->dob) . ' anos'
                : now()->diffInYears($this->dob) . ' ano',
            'birthday' => $this->when($request->routeIs(['alunos.index','alunos.show','classes.show']), Carbon::createFromFormat('Y-m-d', $this->dob)->format('d/m/Y')),
            'dob' => $this->when($request->routeIs(['alunos.edit']), $this->dob),
            'genderMessage' => $this->gender === 'm' ? "do aluno $this->name " : "da aluna $this->name",
            'contact' => $this->when($request->routeIs(['alunos.show','alunos.edit']), $this->contact),
            'address' => $this->when($request->routeIs(['alunos.show','alunos.edit']), $this->address),
            'district' => $this->when($request->routeIs(['alunos.show','alunos.edit']), $this->district),
            'city' => $this->when($request->routeIs(['alunos.show','alunos.edit']), $this->city),
            'zipcode' => $this->when($request->routeIs(['alunos.show','alunos.edit']), $this->zipcode)
        ];
    }
}
