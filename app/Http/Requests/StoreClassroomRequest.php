<?php

namespace App\Http\Requests;

use App\Enums\ClassroomColors;
use App\Models\Classroom;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StoreClassroomRequest extends FormRequest
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
        $this->merge([
            'slug' => Str::slug($this->name)
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255', Rule::unique('classrooms')],
            'color' => ['required','string','max:255', new Enum(ClassroomColors::class)],
            'slug' => ['required','string','max:255']
        ];
    }
}
