<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListPokemonRequest extends FormRequest
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
            'offset' => 'required|int',
            'limit'  => 'required|int'
        ];
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->input('offset');
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->input('limit');
    }
}
