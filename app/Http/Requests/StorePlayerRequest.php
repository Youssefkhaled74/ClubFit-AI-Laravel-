<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlayerRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255'],
            'age' => ['required','integer','between:15,45'],
            'position' => ['required','string','max:10'],
            'market_value' => ['required','numeric','min:0'],
            'salary' => ['required','numeric','min:0'],
            'contract_years' => ['required','integer','between:1,8'],
            'goals' => ['required','integer','min:0'],
            'assists' => ['required','integer','min:0'],
            'passing_accuracy' => ['required','numeric','between:0,100'],
            'pressing_score' => ['required','numeric','between:0,100'],
            'minutes_played' => ['required','integer','min:0'],
            'injury_history' => ['required','integer','between:0,100'],
        ];
    }
}
