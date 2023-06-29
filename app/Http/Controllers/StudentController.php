<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class StudentController extends Controller
{
    public function index(): Response
    {
        return inertia('Students/Index', [
            'students' => StudentResource::collection(Student::orderBy('name')->paginate(20))
        ]);
    }

    public function create(): Response
    {
        return inertia('Students/Create');
    }

    public function store(StoreStudentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            Student::create($validated);

        } catch (\Exception $e) {
            return back()->with('alert', [
                'id' => rand(1, 10000),
                'type' => 'failure',
                'title' => 'Erro',
                'message' => "O cadastro não pode ser realizado!"
            ]);
        }

        return to_route('estudantes.index')->with('alert', [
            'id' => rand(1, 10000),
            'type' => 'success',
            'title' => 'Cadastro Realizado',
            'message' => "O aluno/a {$validated['name']} foi cadastrado!"
        ]);
    }

    public function show(Student $student): Response
    {
        return inertia('Students/Show', [
            'student' => new StudentResource(Student::findOrFail($student->id))
        ]);
    }

    public function edit(Student $student): Response
    {
        return inertia('Students/Edit', [
            'student' => new StudentResource(Student::findOrFail($student->id))
        ]);
    }

    public function update(StoreStudentRequest $request, Student $student): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $student->update($validated);
        } catch (\Exception $e) {
            return back()->with('alert', [
                'id' => rand(1, 10000),
                'type' => 'failure',
                'title' => 'Erro',
                'message' => "A atualização não pode ser realizada!"
            ]);
        }

        return to_route('estudantes.index')->with('alert', [
            'id' => rand(1, 10000),
            'type' => 'success',
            'title' => 'Atualização Realizada',
            'message' => "Os dados do/a aluno/a {$validated['name']} foram atualizados!"
        ]);
    }

    public function destroy(Student $student): RedirectResponse
    {
        $studentName = $student->name;
        try {
            $student->delete();
        } catch (\Exception $e) {
            return back()->with('alert', [
                'id' => rand(1, 10000),
                'type' => 'failure',
                'title' => 'Erro',
                'message' => "A exclusão não pode ser realizada!"
            ]);
        }

        return back()->with('alert', [
            'id' => rand(1, 10000),
            'type' => 'success',
            'title' => 'Exclusão Realizada',
            'message' => "Os dados do/a aluno/a $studentName foram excluídos!"
        ]);
    }
}
