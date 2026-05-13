<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnalysisReport extends Model
{
    protected $fillable = [
        'club_profile_id','player_id','user_id','technical_fit','tactical_fit','financial_fit','medical_risk','squad_need','final_fit_score','recommendation',
    ];

    public function clubProfile(): BelongsTo
    {
        return $this->belongsTo(ClubProfile::class);
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
