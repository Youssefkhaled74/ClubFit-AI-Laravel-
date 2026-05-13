<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClubIdentity extends Model
{
    protected $fillable = ['club_id','football_philosophy','business_model','prefers_youth','prefers_experience','resale_focus','star_player_policy','local_player_policy','multi_position_preference','risk_appetite'];
    public function club(): BelongsTo { return $this->belongsTo(Club::class); }
}
