<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user'); // Mendapatkan nilai ID pengguna dari URL
        return [
                'name'=> 'required|string|max:50',
                'email'=> 'required|email|unique:users,email,' . $userId,
                'roles' => 'nullable|string|in:ADMIN,USER'
        ];
    }
}
