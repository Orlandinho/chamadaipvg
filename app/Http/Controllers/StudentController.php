<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class StudentController extends Controller
{
    public function index(): Response
    {
        return inertia('Students/Index', [
            'students' => StudentResource::collection(
                Student::with('classroom')
                ->orderBy('name')
                ->paginate(20)
            )
        ]);
    }

    public function create(): Response
    {
        return inertia('Students/Create', [
            'classrooms' => Classroom::select('id','name')->get()
        ]);
    }

    public function store(StoreStudentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $student = Student::create($validated);

        } catch (\Exception $e) {
            return back()->with('alert', [
                'type' => 'failure',
                'title' => 'Erro',
                'message' => "O cadastro não pode ser realizado!"
            ]);
        }

        return to_route('alunos.index')->with('alert', [
            'type' => 'success',
            'title' => 'Cadastro Realizado',
            'message' => "Os dados " . $this->studentGenderMessage($student) . " foram cadastrados!"
        ]);
    }

    public function show(Student $student): Response
    {
        return inertia('Students/Show', [
            'student' => new StudentResource(Student::with('classroom')->findOrFail($student->id))
        ]);
    }

    public function edit(Student $student): Response
    {
        return inertia('Students/Edit', [
            'student' => new StudentResource(Student::with('classroom')->findOrFail($student->id))
        ]);
    }

    public function update(StoreStudentRequest $request, Student $student): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $student->update($validated);
        } catch (\Exception $e) {
            return back()->with('alert', [
                'type' => 'failure',
                'title' => 'Erro',
                'message' => "A atualização não pode ser realizada!"
            ]);
        }

        return to_route('alunos.index')->with('alert', [
            'type' => 'success',
            'title' => 'Atualização Realizada',
            'message' => "Os dados " . $this->studentGenderMessage($student) . " foram atualizados!"
        ]);
    }

    public function destroy(Student $student): RedirectResponse
    {
        try {
            $student->delete();
        } catch (\Exception $e) {
            return back()->with('alert', [
                'type' => 'failure',
                'title' => 'Erro',
                'message' => "A exclusão não pode ser realizada!"
            ]);
        }

        return back()->with('alert', [
            'type' => 'success',
            'title' => 'Exclusão Realizada',
            'message' => "Os dados " . $this->studentGenderMessage($student) . " foram excluídos!"
        ]);
    }

    protected function studentGenderMessage(Student $student): string
    {
        return $student->gender === 'm' ? "do aluno {$student->name}" : "da aluna {$student->name}";
    }
}
