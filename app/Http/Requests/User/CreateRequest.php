<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name"     => "required|string|max:255",
            "lastname" => "required|string|max:255",
            "age"      => "required|integer",
            "gender"   => "required|string|in:M,F",
            "email"    => "required|email|max:100|unique:users,email",
            "password" => "required|string|min:8",
        ];
    }
}
