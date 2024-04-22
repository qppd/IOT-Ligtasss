<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Kreait\Firebase\Contract\Database;

use App\Models\User;
use App\Models\Gate;


class FaceController extends Controller
{
    protected $database;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    function fetchSmartGate()
    {
        $reset_ultrasonic_data = [
            'ultrasonic1' => 200,
            'ultrasonic2' => 200,
        ];
        
        $postRef = $this->database->getReference('datas/gate/reading/')->set($reset_ultrasonic_data);

        $staffs = User::select(
            'users.user_id',
        )
            ->where('users.status', '=', 1)
            ->whereIn('users.role', [1, 2, 3])
            ->get();

        //dd($staffs);    
        $staffs = $staffs->pluck('user_id')->toArray();
        return view('face', ['staffs' => $staffs]);

    }

    function fetchGateData()
    {
        $reference = $this->database->getReference('datas/gate');
        $snapshot = $reference->getSnapshot();
        $value = $snapshot->getValue();
        return response()->json($value);
    }

    public function saveGateEntry(Request $request)
    {

        $reset_ultrasonic_data = [
            'ultrasonic1' => 200,
            'ultrasonic2' => 200,
        ];
        
        $postRef = $this->database->getReference('datas/gate/reading/')->set($reset_ultrasonic_data);

        // Extract temperature, humidity, smoke, and flame values from the request
        $user_id = $request->input('user_id');
        $temperature = $request->input('temperature');
        $metal = $request->input('metal');

        // Check if request was successful

        //$firelogs = Firelogs::where('module_id', $id)->get();



        $gate = new Gate();
        $gate->face_id = $user_id;
        $gate->body_temperature = $temperature;
        $gate->metal_detection = $metal;

        $gate->save();



        // Handle the prediction here
        return response()->json(['result' => "1"]);

    }


}
