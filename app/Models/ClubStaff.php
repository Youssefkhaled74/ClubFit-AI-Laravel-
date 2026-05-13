<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClubStaff extends Model
{
    protected $table = 'club_staff';
    protected $fillable = ['club_id','name','role','email','can_approve_reports','can_create_players','can_view_financials','can_view_medical'];
    public function club(): BelongsTo { return $this->belongsTo(Club::class); }
}
