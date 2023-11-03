<?php

namespace App\Http\Controllers;

use App\Services\CourierServiceFactory;
use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;

class DeliveryController extends Controller
{
    public function sendToCourier(Request $request)
    {
        try {
            // Get the selected courier service name from the request.
            $serviceName = $request->input('serviceName');

            // Create a courier service instance based on the selected service name.
            $courierService = CourierServiceFactory::create($serviceName);

            // Extract delivery and recipient data from the request.
            $deliveryData = $request->only(['width', 'height', 'length', 'weight']);
            $recipientData = $request->only(['customer_name', 'phone_number', 'email', 'delivery_address']);

            // Send the data to the selected courier service and get the response.
            $response = $courierService->sendData($deliveryData, $recipientData);

            // Return the response as a JSON response.
            return response()->json($response);
        } catch (ValidationException $e) {
            // Handle validation errors by returning a 400 Bad Request response.
            return response()->json(['error' => 'Invalid input data'], Response::HTTP_BAD_REQUEST);
        } catch (QueryException $e) {
            // Handle database query errors by returning a 500 Internal Server Error response.
            return response()->json(['error' => 'Database error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            // Handle other exceptions by returning a 500 Internal Server Error response.
            return response()->json(['error' => 'An error occurred'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
