<?php

namespace App\Http\Controllers;

use App\Enums\ClassroomColors;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Http\Resources\ClassroomResource;
use App\Http\Resources\StudentResource;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class ClassroomController extends Controller
{
    public function index(): Response
    {
        return inertia('Classrooms/Index', [
            'classrooms' => ClassroomResource::collection(Classroom::all()->load('students')->loadCount('students'))
        ]);
    }

    public function create(): Response
    {
        return inertia('Classrooms/Create', [
            'colors' => $this->allColors()
        ]);
    }

    public function store(StoreClassroomRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            Classroom::create($validated);

        } catch (\Exception $e) {
            return back()->with('alert', [
                'type' => 'failure',
                'title' => 'Erro',
                'message' => "Não foi possível criar a classe " . $validated['name']
            ]);
        }

        return to_route('classes.index')->with('alert', [
            'type' => 'success',
            'title' => 'Classe criada',
            'message' => "A classe " . $validated['name'] . " foi criada!"
        ]);
    }

    public function show(Classroom $classroom): Response
    {
        return inertia('Classrooms/Show', [
            'classroom' => new ClassroomResource($classroom),
            'students' => StudentResource::collection(Student::where('classroom_id', $classroom->id)->orderBy('name')->get())
        ]);
    }

    public function edit(Classroom $classroom): Response
    {
        return inertia('Classrooms/Edit', [
            'classroom' => new ClassroomResource($classroom),
            'colors' => $this->allColors()
        ]);
    }

    public function update(UpdateClassroomRequest $request, Classroom $classroom): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $classroom->update($validated);

        } catch (\Exception $e) {
            return back()->with('alert', [
                'type' => 'failure',
                'title' => 'Erro',
                'message' => "Não foi possível atualizar a classe " . $validated['name']
            ]);
        }

        return to_route('classes.index')->with('alert', [
            'type' => 'success',
            'title' => 'Atualização de classe',
            'message' => "A classe " . $validated['name'] . " foi atualizada!"
        ]);
    }

    public function destroy(Classroom $classroom): RedirectResponse
    {
        $className = $classroom->name;
        try {
            $classroom->delete();
        } catch(\Exception $e) {
            return back()->with('alert', [
                'type' => 'failure',
                'title' => 'Erro',
                'message' => "Não foi possível excluir a classe " . $className
            ]);
        }

        return to_route('classes.index')->with('alert', [
            'type' => 'success',
            'title' => 'Atualização de classe',
            'message' => "A classe " . $className . " foi excluída!"
        ]);
    }

    protected function allColors(): array
    {
        $colors = [];
        foreach (ClassroomColors::cases() as $color) {
            $colors[] = array(
                'name' => $color->value,
                'bgColor' => $color->bgColor(),
                'ringColor' => $color->ringColor()
            );
        }

        return $colors;
    }
}
