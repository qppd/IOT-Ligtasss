<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use Kreait\Firebase\Contract\Database;
use GuzzleHttp\Client;

use App\Models\User;
use App\Models\Fire;
use App\Models\Room;
use App\Models\Flood;
use App\Models\Token;
use App\Models\Firelogs;
use App\Models\Floodlogs;


class AdminDashboardController extends Controller
{

    protected $database;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    function fetchAdminDashboard()
    {

        $smart_gate = [];
        $smart_room = [];
        // $smart_gate = User::whereIn('role', [0, 1])
        //     ->select(DB::raw('COUNT(*) as administrator_count'))
        //     ->get();

        // $smart_room = User::where('role', '=', 2)
        //     ->select(DB::raw('COUNT(*) as professors_count'))
        //     ->get();

        //$employee_count = 0;
        $employee_count = User::where('role', '=', 1)
            ->select(DB::raw('COUNT(*) as employee_count'))
            ->get();

        $student_count = User::where('role', '=', 3)
            ->select(DB::raw('COUNT(*) as student_count'))
            ->get();
        //$student_count = 0;

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

        $flood_detection_modules = Flood::select(
            'floods.device_id',
        )
            ->where('floods.status', '=', 1)
            ->get();

        $fire_detection_modules = $fire_detection_modules->pluck('module_id')->toArray();
        $room_devices = $room_devices->pluck('device_id')->toArray();
        $flood_detection_modules = $flood_detection_modules->pluck('device_id')->toArray();

        $reference = $this->database->getReference('datas');
        $snapshot = $reference->getSnapshot();
        $value = $snapshot->getValue();

        if (!empty($value['tokens'])) {
            foreach ($value['tokens'] as $pushedKey => $tokenData) {
                $tokenId = $tokenData['device_token'];
                // Use $tokenId as needed
                //dd($tokenId);

                $token = Token::where('token', $tokenId)->first();
                if (!$token) {
                    $token = new Token();
                    $token->token = $tokenId;
                    $token->save();
                }
            }
        } else {
            // Handle case where 'tokens' array is empty or doesn't exist
        }

        $play_buzzer = [
            'relay' => 0,
        ];

        $postRef = $this->database->getReference('datas/modules/1454768933')->set($play_buzzer);



        return view('admin/dashboard', [
            'fire_detection_modules' => $fire_detection_modules,
            'room_devices' => $room_devices,
            'flood_detection_modules' => $flood_detection_modules,
            'employee_count' => $employee_count,
            'student_count' => $student_count
        ]);
    }

    function fetchAdminDashboardData()
    {
        $reference = $this->database->getReference('datas');
        $snapshot = $reference->getSnapshot();
        $value = $snapshot->getValue();

        return response()->json($value);
    }


    function sendBroadcastMessage(Request $request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = Token::whereNotNull('token')->pluck('token')->all();

        $serverKey = 'AAAATVHUNVI:APA91bGTII9qmeVXRVwaScYYXVaWaaCTNOxS0EZ8MWOmZ8AaZY8rVrlhBsrOfLNeETXkgHGZ8Jja526FwW-fXmE1_IHrldfmtitmJqBVyMfi2CYl1amEZoxvikInth08kp_yEosGJPy-';

        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->message,
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
        //sendMessage();
    }

    public function sendMessage()
    {
        $client = new Client();

        // Semaphore API parameters
        $parameters = [
            'apikey' => '32f4a56db6455f3c2bdf758ee0108599',
            'number' => '09481820290',
            'message' => 'Alert from Ligtasss! Please respond to Calauag National High School immediately!',
            'sendername' => 'THESIS'
        ];

        try {
            $response = $client->post('https://semaphore.co/api/v4/messages', [
                'form_params' => $parameters
            ]);

            // Handle success response
            $statusCode = $response->getStatusCode();
            $body = $response->getBody()->getContents();


            return response()->json([
                'status' => $statusCode,
                'response' => $body
            ]);

        } catch (\Exception $e) {
            // Handle exception
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function detectFire(Request $request)
    {
        // Extract temperature, humidity, smoke, and flame values from the request
        $module_id = $request->input('module_id');
        $temperature = $request->input('temperature');
        $humidity = $request->input('humidity');
        $smoke = $request->input('smoke');
        $flame = $request->input('flame');

        // Make API request to Flask server
        $response = Http::post('http://localhost:5000/detect-fire', [
            'temperature' => $temperature,
            'humidity' => $humidity,
            'smoke' => $smoke,
            'flame' => $flame,
        ]);

        // Check if request was successful
        if ($response->successful()) {
            $prediction = $response->json('result');

            $fires_log = new Firelogs();
            $fires_log->module_id = $module_id;
            $fires_log->temperature = $temperature;
            $fires_log->humidity = $humidity;
            $fires_log->smoke = $smoke;
            $fires_log->flame = $flame;
            $fires_log->fire = $prediction;
            $fires_log->save();

            if ($prediction == "1" || $prediction == "2") {
                $play_buzzer = [
                    'relay' => 1,
                ];

                $postRef = $this->database->getReference('datas/modules/' . $module_id)->set($play_buzzer);

            }

            // Handle the prediction here
            return response()->json(['result' => $prediction]);
        } else {
            // Handle the case where the request failed
            return response()->json(['error' => 'Failed to detect fire'], $response->status());
        }
    }

    public function saveFlood(Request $request)
    {
        // Extract temperature, humidity, smoke, and flame values from the request
        $device_id = $request->input('device_id');
        $distance = $request->input('distance');

        $flood_log = new Floodlogs();
        $flood_log->device_id = $device_id;
        $flood_log->distance = $distance;
        $isSaved = $flood_log->save();


        // Check if request was successful
        if ($isSaved) {
            // Handle the prediction here
            return response()->json(['result' => 1]);
        } else {
            // Handle the case where the request failed
            return response()->json(['error' => 'Failed to save flood log!'], 0);
        }
    }




}
