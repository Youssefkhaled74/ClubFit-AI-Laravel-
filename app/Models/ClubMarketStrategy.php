<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClubMarketStrategy extends Model
{
    protected $fillable = ['club_id','strategy_type','target_regions','target_countries','target_leagues','market_value_range_min','market_value_range_max','preferred_deal_type','undervalued_player_focus','free_agent_focus','loan_market_focus'];
    protected function casts(): array { return ['target_regions'=>'array','target_countries'=>'array','target_leagues'=>'array']; }
    public function club(): BelongsTo { return $this->belongsTo(Club::class); }
}
