<?php

namespace App\Http\Requests\Profiles;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = User::firstWhere('id', Auth::id());

        return Auth::check() && $user->hasRole(['super_admin', 'admin']);
    }


    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->cpf) {
            $this->merge([
                'cpf' => str_replace(['-', '.', '(', ')', ' '], '', $this->cpf)
            ]);
        }

        if ($this->phone) {
            $this->merge([
                'phone' => str_replace(['-', '.', '(', ')', ' '], '', $this->phone)
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'min:3', 'max:255'],
            'email' => ['nullable', 'email', "unique:users,email,{$this->user->id},id"],
            'password' => ['nullable', 'confirmed', 'min:8'],
            'cpf' => ['nullable', 'size:11', "unique:users,cpf,{$this->user->id},id"],
            'birth_date' => ['nullable', 'date'],
            'phone' => ['nullable', 'min:10', 'max:11'],
            'sex' => ['nullable'],
        ];
    }

    public function attributes(): array
    {
        return [
            'birth_date' => 'data de aniversário'
        ];
    }
}
