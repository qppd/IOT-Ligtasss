<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Room;


class AdminRoomController extends Controller
{
    function fetchRooms()
    {

        $rooms = Room::select(
            'rooms.id',
            'rooms.device_id',
            'rooms.room_no',
            'rooms.room_name',
            'rooms.status'
        )
            ->get();

        return view('admin/room', ['rooms' => $rooms]);
    }

    function addRoom(Request $request)
    {
        $validation = [
            'device_id' => 'required|min:10|max:255',
            'room_no' => 'required|min:1|max:2',
            'room_name' => 'required|min:3|max:10',
        ];

        $request->validate($validation);

        $room = Room::where('device_id', $request->device_id)->first();

        if ($room)
            return redirect()->back()->withErrors([
                'message' => 'Room add failed! Device ID already exists!',
            ]);

        $room = Room::where('room_no', $request->room__no)->first();

        if ($room)
            return redirect()->back()->withErrors([
                'message' => 'Room add failed! Room number already exists!',
            ]);

        $room = new Room;
        $room->device_id = $request->device_id;
        $room->room_no = $request->room_no;
        $room->room_name = $request->room_name;

        $isSaved = $room->save();
        if ($isSaved) {
            return redirect()->back()->with('success', 'Room has been added successfully!');
        } else {
            return redirect()->back()->withErrors([
                'message' => 'Room add failed! Try again!',
            ]);
        }

    }

    function editRoom(Request $request)
    {
        $validation = [
            'id' => 'required',
            'device_id' => 'required',
            'room_no' => 'required|min:1|max:3',
            'room_name' => 'required|min:3|max:50',
            'status' => 'required',
        ];

        $request->validate($validation);


        $room = Room::find($request->id);
        $room->device_id = $request->device_id;
        $room->room_no = $request->room_no;
        $room->room_name = $request->room_name;
        $room->status = $request->status;

        if (!$room) {
            return redirect()->back()->withErrors([
                'message' => 'Room device not found! Try again!',
            ]);
        }

        $isSaved = $room->save();
        if ($isSaved) {
            return redirect()->back()->with(
                'success',
                'Room device has been updated successfully!'
            );
        } else {
            return redirect()->back()->withErrors([
                'message' => 'Room device update failed! Try again later!',
            ]);
        }



    }


    function deleteRoom($id)
    {
        $room = Room::find($id);

        // if (!$employee) {
        //     return redirect()->back()->withErrors([
        //         'message' => 'Employee not found! Try again!',
        //     ]);
        // }

        $isDeleted = $room->delete();
        if ($isDeleted) {
            return redirect()->back()->with('success', 'Room device has been deleted successfully!');
        } else {
            return redirect()->back()->withErrors([
                'message' => 'Room device delete failed! Try again!',
            ]);
        }
    }

}
