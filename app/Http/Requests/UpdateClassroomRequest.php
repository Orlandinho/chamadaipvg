<?php

namespace App\Http\Requests;

use App\Enums\ClassroomColors;
use App\Models\Classroom;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateClassroomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $classroom = Classroom::findOrFail($this->id);

        if($this->name !== $classroom->name){
            $this->merge([
                'slug' => Str::slug($this->name)
            ]);
        } else {
            $this->merge([
                'slug' => $classroom->slug
            ]);
        }

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255', Rule::unique('classrooms')->ignore($this->id)],
            'color' => ['required','string','max:255', new Enum(ClassroomColors::class)],
            'slug' => ['required','string','max:255']
        ];
    }
}
