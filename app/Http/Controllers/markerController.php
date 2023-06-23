<?php

namespace App\Http\Controllers;

use App\Events\MarkerListener;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MarkerController extends Controller
{
    public function onAddMarker(Request $request)
    {
        $userController = new userAuthController();
        $coord = $this->generateRandomCoordinate();
        $data = [
            'user' => $userController->getUserName($request->userId),
            'marker_id' => Str::uuid()->toString(),
            'lat' => $coord['latitude'],
            'lng' => $coord['longitude'],
            'comment' => '',
            'response' => 1,
        ];

        // Broadcast the message to the specified channel
        broadcast(new MarkerListener(json_encode($data)))->toOthers();

        return response()->json(['success' => true, 'message' => $data]);
    }

    private function generateRandomCoordinate()
    {
        $latitude = mt_rand(-90, 90); // Generate a random latitude between -90 and 90
        $longitude = mt_rand(-180, 180); // Generate a random longitude between -180 and 180

        return ['latitude' => $latitude, 'longitude' => $longitude];
    }
}
