<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClubProfileRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'club_name' => ['required', 'string', 'max:255'],
            'formation' => ['required', 'string', 'max:255'],
            'playing_style' => ['required', 'string', 'max:255'],
            'budget' => ['required', 'numeric', 'min:0'],
            'salary_limit' => ['required', 'numeric', 'min:0'],
            'needed_positions' => ['required', 'array', 'min:1'],
            'needed_positions.*' => ['string', 'max:10'],
            'age_min' => ['required', 'integer', 'between:15,45'],
            'age_max' => ['required', 'integer', 'between:15,45', 'gte:age_min'],
            'injury_tolerance' => ['required', 'integer', 'between:0,100'],
        ];
    }
}
