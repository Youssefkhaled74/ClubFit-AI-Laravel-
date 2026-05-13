<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Club extends Model
{
    protected $fillable = ['name','country','league','season','logo','primary_color','secondary_color','currency','club_level','created_by'];

    public function user(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
    public function identity(): HasOne { return $this->hasOne(ClubIdentity::class); }
    public function tacticalProfile(): HasOne { return $this->hasOne(ClubTacticalProfile::class); }
    public function financialRule(): HasOne { return $this->hasOne(ClubFinancialRule::class); }
    public function recruitmentPolicy(): HasOne { return $this->hasOne(ClubRecruitmentPolicy::class); }
    public function medicalPolicy(): HasOne { return $this->hasOne(ClubMedicalPolicy::class); }
    public function squadNeeds(): HasMany { return $this->hasMany(ClubSquadNeed::class); }
    public function teamMetrics(): HasMany { return $this->hasMany(ClubTeamMetric::class); }
    public function staff(): HasMany { return $this->hasMany(ClubStaff::class); }
    public function contractRule(): HasOne { return $this->hasOne(ClubContractRule::class); }
    public function marketStrategy(): HasOne { return $this->hasOne(ClubMarketStrategy::class); }
}
