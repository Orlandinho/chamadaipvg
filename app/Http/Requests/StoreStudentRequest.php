<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function makeSlugFromName(): string
    {
        $slug = Str::slug($this->name);

        $count = Student::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => $this->makeSlugFromName()
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
            'name' => ['required','max:255'],
            'gender' => ['required','string','in:f,m'],
            'slug' => ['required','max:255'],
            'email' => ['required','max:255','email'],
            'dob' => ['required','date_format:Y-m-d','before_or_equal:' . now()->format('Y-m-d')],
            'contact' => ['required','regex:/^\((\d){2}\) (\d){5}-(\d){4}$/'],
            'address' => ['required','max:255'],
            'district' => ['required','max:255'],
            'city' => ['required','max:255'],
            'zipcode' => ['required','regex:/^(\d){8}$/'],
        ];
    }
}
