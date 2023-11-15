<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListTrainerRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'page' => 'required|int',
        ];
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->input('page', 1);
    }
}
