<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClubContractRule extends Model
{
    protected $fillable = ['club_id','max_contract_years','min_contract_years','release_clause_policy','bonus_policy','image_rights_policy','sell_on_policy','buy_back_policy','loan_policy','agent_fee_policy'];
    public function club(): BelongsTo { return $this->belongsTo(Club::class); }
}
