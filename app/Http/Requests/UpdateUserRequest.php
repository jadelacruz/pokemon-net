<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'firstName'  => 'required|min:2|max:30',
            'lastName'   => 'required|min:2|max:30',
            'email'      => 'required|min:8|max:100',
            'password'   => 'required|min:8|max:16',
            'rePassword' => 'required|same:password'
        ];
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->input('firstName');
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->input('lastName');
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->input('email');
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->input('password');
    }

    /**
     * @return string
     */
    public function getRetypedPassword(): string
    {
        return $this->input('rePassword');
    }
}
