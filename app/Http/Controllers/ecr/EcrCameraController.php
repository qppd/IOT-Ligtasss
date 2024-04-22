<?php

namespace App\Http\Controllers\ecr;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Camera;
use App\Models\User;
use Kreait\Firebase\Contract\Database;


class EcrCameraController extends Controller
{
    protected $database;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    function viewCamera($id)
    {
        return view('ecr/live_feed', ['id' => $id]);
    }

    function fetchCameras()
    {

        $cameras = Camera::select(
            'cameras.camera_id',
            'cameras.type',
            'cameras.status'
        )   ->where('cameras.type', 1)
            ->get();

        return view('ecr/camera', ['cameras' => $cameras]);
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
        $camera->delete();

        return redirect()->back()->with('success', 'Camera has been deleted successfully!');
    }

    public function findFaceId($label)
    {
        $user = User::where('id', $label)->first();

        if ($user) {
            return response()->json($user);
        } else {

            return response()->json(['message' => $label], 404);
        }
    }

    function fetchESP32CameraFrame($id){
        $reference = $this->database->getReference('datas/cameras/' . $id);
        $snapshot = $reference->getSnapshot();

        
        $value = $snapshot->getValue();

        return response()->json($value);
    }




}
