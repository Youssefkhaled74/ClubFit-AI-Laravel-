<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClubRecruitmentPolicy extends Model
{
    protected $fillable = ['club_id','min_age','max_age','preferred_nationalities','blocked_nationalities','preferred_leagues','blocked_leagues','min_experience_level','requires_international_experience','requires_european_experience','language_preference','resale_potential_min','foreign_player_slots_available','homegrown_requirement'];
    protected function casts(): array { return ['preferred_nationalities'=>'array','blocked_nationalities'=>'array','preferred_leagues'=>'array','blocked_leagues'=>'array']; }
    public function club(): BelongsTo { return $this->belongsTo(Club::class); }
}
