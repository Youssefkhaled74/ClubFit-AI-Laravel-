<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnalysisReportRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'club_profile_id' => ['required','exists:club_profiles,id'],
            'player_id' => ['required','exists:players,id'],
        ];
    }
}
