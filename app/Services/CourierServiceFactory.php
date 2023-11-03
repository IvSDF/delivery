<?php

namespace App\Services;

class CourierServiceFactory
{
    public static function create($serviceName)
    {
        // Get the class name of the selected courier service from the configuration.
        $serviceClass = config("delivery.services.$serviceName");

        // Check if the service class exists and is valid.
        if ($serviceClass && class_exists($serviceClass)) {
            // Create a new instance of the selected courier service and return it.
            return new $serviceClass();
        } else {
            // If the service is not found or the class doesn't exist, throw an exception.
            throw new \Exception('Unknown courier service');
        }
    }
}
