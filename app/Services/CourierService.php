<?php

namespace App\Services;

interface CourierService
{
    // This method should be implemented by all courier service classes.
    public function sendData(array $deliveryData, array $recipientData);
}
