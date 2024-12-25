<?php

namespace App\Enums;

enum EmergencyContectPersonEnum: string
{
    case  Spouse = 'Spouse';
    case  Partner  = 'Partner';
    case  Parent = 'Parent';
    case  Guardian  = 'Guardian';
    case  Friend  = 'Friend';
    case  Sibling = 'Sibling';
    case  Other  = 'Other';
}