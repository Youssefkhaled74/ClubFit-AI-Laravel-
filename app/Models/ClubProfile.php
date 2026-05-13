<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClubProfile extends Model
{
    protected $fillable = [
        'user_id','club_name','formation','playing_style','budget','salary_limit','needed_positions','age_min','age_max','injury_tolerance',
    ];

    protected function casts(): array
    {
        return ['needed_positions' => 'array'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(AnalysisReport::class);
    }
}
