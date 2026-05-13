<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClubSquadNeed extends Model
{
    protected $fillable = ['club_id','position','need_level','required_role','priority','current_players_count','average_age','quality_level','needs_starter','needs_backup','needs_future_prospect','replace_departing_player','notes'];
    public function club(): BelongsTo { return $this->belongsTo(Club::class); }
}
