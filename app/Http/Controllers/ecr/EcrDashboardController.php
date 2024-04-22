<?php

namespace App\Http\Controllers\ecr;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Kreait\Firebase\Contract\Database;

use App\Models\User;
use App\Models\Fire;
use App\Models\Room;
use App\Models\Token;


class EcrDashboardController extends Controller
{

    protected $database;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    function fetchECRDashboard()
    {

        $smart_gate = [];
        $smart_room = [];
        // $smart_gate = User::whereIn('role', [0, 1])
        //     ->select(DB::raw('COUNT(*) as administrator_count'))
        //     ->get();

        // $smart_room = User::where('role', '=', 2)
        //     ->select(DB::raw('COUNT(*) as professors_count'))
        //     ->get();

        $employee_count = User::where('role', '=', 1)
        ->select(DB::raw('COUNT(*) as employee_count'))
        ->get();

        $student_count = User::where('role', '=', 3)
            ->select(DB::raw('COUNT(*) as student_count'))
            ->get();

        
        $fire_detection_modules = Fire::select(
            'fires.module_id',
        )
            ->where('fires.status', '=', 1)
            ->get();

        $room_devices = Room::select(
            'rooms.device_id',
        )
            ->where('rooms.status', '=', 1)
            ->get();

        $fire_detection_modules = $fire_detection_modules->pluck('module_id')->toArray();
        $room_devices = $room_devices->pluck('device_id')->toArray();

        return view('ecr/dashboard', [
            'fire_detection_modules' => $fire_detection_modules,
            'room_devices' => $room_devices,
            'employee_count' => $employee_count,
            'student_count' => $student_count
        ]);
    }

    function fetchECRDashboardData()
    {
        $reference = $this->database->getReference('datas');
        $snapshot = $reference->getSnapshot();
        $value = $snapshot->getValue();
        return response()->json($value);
    }


    public function sendECRBroadcastMessage()
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = Token::whereNotNull('token')->pluck('token')->all();

        $user = 'User';

        $serverKey = 'AAAATVHUNVI:APA91bGTII9qmeVXRVwaScYYXVaWaaCTNOxS0EZ8MWOmZ8AaZY8rVrlhBsrOfLNeETXkgHGZ8Jja526FwW-fXmE1_IHrldfmtitmJqBVyMfi2CYl1amEZoxvikInth08kp_yEosGJPy-'
        ;

        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => "ALERT",
                "message"=>  "ALERT",
            ]
        ];

        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

        // Execute post
        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        // FCM response
        return response()->json($result);
    }



}
