<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClubTeamMetric extends Model
{
    protected $fillable = ['club_id','season','goals_scored','goals_conceded','xg','xga','xa','shots_per_match','shots_on_target_per_match','possession_percentage','pass_accuracy','progressive_passes','final_third_entries','box_entries','ppda','high_turnovers','successful_counter_attacks','cross_accuracy','set_piece_goals'];
    public function club(): BelongsTo { return $this->belongsTo(Club::class); }
}
