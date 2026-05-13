<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    protected $fillable = [
        'name','age','position','market_value','salary','contract_years','goals','assists','passing_accuracy','pressing_score','minutes_played','injury_history',
    ];

    public function reports(): HasMany
    {
        return $this->hasMany(AnalysisReport::class);
    }
}
