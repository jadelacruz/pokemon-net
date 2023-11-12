<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name'       => 'required|min:6|max:50',
            'username'   => 'required|min:8|max:16|unique:users,username',
            'password'   => 'required|min:8|max:16',
            'rePassword' => 'required|same:password'
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->input('name');
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->input('username');
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
