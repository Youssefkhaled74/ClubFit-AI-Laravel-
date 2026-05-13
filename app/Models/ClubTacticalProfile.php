<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClubTacticalProfile extends Model
{
    protected $fillable = ['club_id','primary_formation','secondary_formation','attacking_shape','defensive_shape','pressing_style','build_up_style','tempo','directness','possession_target','width_preference','counter_attack_preference','crossing_preference','set_piece_importance','passing_risk_level','defensive_line_height'];
    public function club(): BelongsTo { return $this->belongsTo(Club::class); }
}
