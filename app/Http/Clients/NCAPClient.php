<?php

namespace App\Http\Clients;

interface NCAPClient
{
    public function getVariants($modelYear, $maker, $model);
    public function getSafetyRatings($vehicleId);
}
