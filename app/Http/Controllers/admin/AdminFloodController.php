<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Flood;
use App\Models\Floodlogs;

class AdminFloodController extends Controller
{
    function fetchFlood()
    {

        $floods = Flood::select(
            'floods.id',
            'floods.device_id',
            DB::raw('(CASE
                WHEN floods.status = 0 THEN "Inactive"
                WHEN floods.status = 1 THEN "Active"
                ELSE "Unknown" END) as status'),
        )
            ->get();

        return view('admin/flood', ['floods' => $floods]);
    }
    function addModule(Request $request)
    {
        $validation = [
            'id' => 'required|min:10|max:255',
        ];

        $request->validate($validation);

        $flood_detection_device = Flood::where('device_id', $request->id)->first();

        if ($flood_detection_device)
            return redirect()->back()->withErrors([
                'message' => 'Flood detection module add failed! Device ID already exists!',
            ]);

        $flood = new Flood;
        $flood->device_id = $request->id;


        $isSaved = $flood->save();
        if ($isSaved) {
            return redirect()->back()->with('success', 'Flood detection module has been added successfully!');
        } else {
            return redirect()->back()->withErrors([
                'message' => 'Flood detection module add failed! Try again!',
            ]);
        }

    }

    function deleteModule($id)
    {
        $flood = Flood::find($id);
        //dd($id);

        $isDeleted = $flood->delete();
        if ($isDeleted) {
            return redirect()->back()->with('success', 'Flood detection module has been deleted successfully!');
        } else {
            return redirect()->back()->withErrors([
                'message' => 'Fire detection module delete failed! Try again!',
            ]);
        }
    }

    function fetchFloodlogs($id){
        $floodlogs = Floodlogs::where('device_id', $id)->get();

        return view('/admin/floodlogs', ['floodlogs' => $floodlogs]);
    }

}
