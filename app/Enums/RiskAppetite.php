<?php

namespace App\Enums;

enum RiskAppetite: string
{
    case Low = 'low';
    case Balanced = 'balanced';
    case Aggressive = 'aggressive';
}
