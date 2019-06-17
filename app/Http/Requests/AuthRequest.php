<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AuthRequest
 * @package App\Http\Requests
 * @property-read string $email
 * @property-read string $password
 */
class AuthRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'email|required|unique:users',
            'password' => 'required|string|min:6',
        ];
    }
}
