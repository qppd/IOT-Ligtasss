<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

use Kreait\Firebase\Contract\Database;

use App\Models\Camera;
use App\Models\User;

class AdminCameraController extends Controller
{
    protected $database;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    function viewCamera($id)
    {

        $camera = Camera::where('camera_id', $id)->first();

        if (!$camera) {
            return redirect()->back()->withErrors([
                'message' => 'Camera not found',
            ]);
        }

        $staffs = User::select(
            'users.id',
        )
            ->where('users.status', '=', 1)
            ->whereIn('users.role', [0, 1, 2])
            ->get();

        //dd($staffs);    
        $staffs = $staffs->pluck('id')->toArray();
        return view('admin/live_feed', ['id' => $id, 'type' => $camera->type, 'staffs' => $staffs]);
    }

    function fetchCameras()
    {

        $cameras = Camera::select(
            'cameras.id',
            'cameras.camera_id',
            'cameras.url',
            'cameras.type',
            'cameras.status'
        )
            ->where('cameras.type', '=', 1)
            ->get();

        return view('admin/camera', ['cameras' => $cameras]);
    }

    function addCamera(Request $request)
    {
        $validation = [
            'id' => 'required|min:10|max:255',
            'type' => 'required',
        ];

        $request->validate($validation);

        $camera = Camera::where('camera_id', $request->id)->first();

        if ($camera)
            return redirect()->back()->withErrors([
                'message' => 'Camera add failed! Camera ID address already exists!',
            ]);

        $camera = new Camera;
        $camera->camera_id = $request->id;
        $camera->type = $request->type;

        $isSaved = $camera->save();
        if ($isSaved) {
            return redirect()->back()->with('success', 'Camera has been added successfully!');
        } else {
            return redirect()->back()->withErrors([
                'message' => 'Camera add failed! Try again!',
            ]);
        }
    }

    function deleteCamera($id)
    {
        // $validated = $request->validate([
        //     'id' => 'required',
        // ]);

        // if (!$validated) {
        //     return redirect('cameras');
        // }

        $camera = Camera::find($id);
        $isDeleted = $camera->delete();

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Camera has been deleted successfully!');
        } else {
            return redirect()->back()->withErrors([
                'message' => 'Camera delete failed! Try again!',
            ]);
        }
    }

    public function findFaceId($label)
    {
        $user = User::where('user_id', $label)->first();

        if ($user) {
            return response()->json($user);
        } else {

            return response()->json(['message' => $label], 404);
        }
    }

    function fetchESP32CameraFrame($id)
    {
        $reference = $this->database->getReference('datas/cameras/' . $id);
        $snapshot = $reference->getSnapshot();


        $value = $snapshot->getValue();

        return response()->json($value);
    }

    // function fetchVideos($id)
    // {
    //     $videoDirectory = 'C:\xampp\htdocs\iot\storage\app\public\videos';
    //     $videoFiles = scandir($videoDirectory);
    //     $videoFiles = array_diff($videoFiles, ['.', '..']);



    //     return view('admin/videos', ['videos' => $videoFiles]);
    // }
    function fetchVideos($id)
{
    $videoDirectory = 'C:\xampp\htdocs\iot\storage\app\public\videos';
    $videoFiles = scandir($videoDirectory);
    $videoFiles = array_diff($videoFiles, ['.', '..']);

    // Filter out files that do not contain the given ID in their filename
    $filteredVideos = [];
    foreach ($videoFiles as $videoFile) {
        if (strpos($videoFile, $id . '_') !== false) {
            $filteredVideos[] = $videoFile;
        }
    }

    return view('admin/videos', ['videos' => $filteredVideos]);
}

}
