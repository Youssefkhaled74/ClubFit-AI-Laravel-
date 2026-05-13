<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClubMedicalPolicy extends Model
{
    protected $fillable = ['club_id','injury_risk_tolerance','max_injuries_last_2_seasons','max_days_missed_last_2_seasons','accepts_acl_history','accepts_recurring_muscle_injuries','min_minutes_last_season','fitness_priority','medical_review_required'];
    public function club(): BelongsTo { return $this->belongsTo(Club::class); }
}
