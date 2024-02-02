<?php

namespace App\DTO;

enum Version: string
{
    case VERSION_FRANCAISE='VF';
    case VERSION_ORIGINALE='VO';
    case VERSION_SOUS_TITREE='VSTFR';
}