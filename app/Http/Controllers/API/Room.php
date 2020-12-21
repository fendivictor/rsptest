<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Room as RoomModel;
use Validator;

class Room extends BaseController
{
    public function index()
    {
        $rooms = RoomModel::whereNull('deleted_at')->get();

        return $this->sendResponse($rooms, 'Rooms retrieve successfully');
    }

    public function show($id)
    {
        $room = RoomModel::find($id);

        if (is_null($room)) {
            return $this->sendError('Room not found');
        }

        return $this->sendResponse($room, 'Room retrieve successfully');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator =Validator::make($input, [
            'room_name' => 'required',
            'room_capacity' => 'required',
            'photo' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $image = $request->file('photo');

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $endpoint = 'https://api.imgur.com/3/upload';

        $response = Http::withHeaders([
            'Content-Type' => 'multipart/form-data'
        ])->post($endpoint, [
            'image' => fopen($image, 'r')
        ]);

        print_r($response->json());exit;
        
        $room = RoomModel::create($input);

        return $this->sendResponse($room, 'Room successfully created');
    }
}
