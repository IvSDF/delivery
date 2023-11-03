<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class NovaPoshtaService implements CourierService
{
    public function sendData(array $deliveryData, array $recipientData)
    {
        $client = new Client();

        try {
            // Send a POST request to the delivery service
            $response = $client->post('novaposhta.test/api/delivery', [
                'json' => [
                    'customer_name' => $recipientData['customer_name'],
                    'phone_number' => $recipientData['phone_number'],
                    'email' => $recipientData['email'],
                    'sender_address' => config('delivery.sender_address'),
                    'delivery_address' => $recipientData['delivery_address'],
                ]
            ]);

            // Check the response status
            if ($response->getStatusCode() === 200) {
                return json_decode($response->getBody());
            } else {
                // Handle responses with different status codes (e.g., HTTP 500)
                return ['error' => 'Failed to send to the courier service'];
            }
        } catch (RequestException $e) {
            // Handle errors from the server or other connection issues
            return ['error' => 'Error while sending to the courier service: ' . $e->getMessage()];
        }
    }
}
