<?php

namespace App\Http\Requests;

use App\Enums\UserPickTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class StoreUserPickRequest extends FormRequest
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
            'pokemonId' => 'required|int',
            'pickType'  => [
                'required',
                Rule::in(
                    Arr::map(UserPickTypeEnum::cases(), fn(UserPickTypeEnum $enum) => $enum->value)
                )
            ]
        ];
    }

    /**
     * @return int
     */
    public function getPokemonId(): int
    {
        return $this->input('pokemonId');
    }

    /**
     * @return mixed
     */
    public function getPickType(): UserPickTypeEnum
    {
        return UserPickTypeEnum::from(
            $this->input('pickType')
        );
    }
}
