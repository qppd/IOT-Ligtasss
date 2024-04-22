<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Fire;
use App\Models\Firelogs;

class AdminFireController extends Controller
{
    function fetchFire()
    {

        $fires = Fire::select(
            'fires.id',
            'fires.module_id',
            DB::raw('(CASE
                WHEN fires.status = 0 THEN "Inactive"
                WHEN fires.status = 1 THEN "Active"
                ELSE "Unknown" END) as status'),
        )
            ->get();

        return view('admin/fire', ['fires' => $fires]);
    }

    function addModule(Request $request)
    {
        $validation = [
            'id' => 'required|min:10|max:255',
        ];

        $request->validate($validation);

        $fire = Fire::where('module_id', $request->id)->first();

        if ($fire)
            return redirect()->back()->withErrors([
                'message' => 'Fire detection module add failed! Device ID already exists!',
            ]);

        $fire = new Fire;
        $fire->module_id = $request->id;


        $isSaved = $fire->save();
        if ($isSaved) {
            return redirect()->back()->with('success', 'Fire detection module has been added successfully!');
        } else {
            return redirect()->back()->withErrors([
                'message' => 'Fire detection module add failed! Try again!',
            ]);
        }

    }

    function deleteModule($id)
    {
        // $validated = $request->validate([
        //     'id' => 'required',
        // ]);

        // if (!$validated) {
        //     return redirect('cameras');
        // }

        $fires = Fire::find($id);
        //dd($id);

        $isDeleted = $fires->delete();
        if ($isDeleted) {
            return redirect()->back()->with('success', 'Fire has been deleted successfully!');
        } else {
            return redirect()->back()->withErrors([
                'message' => 'Fire detection module delete failed! Try again!',
            ]);
        }
    }

    function fetchFirelogs($id){
        $firelogs = Firelogs::where('module_id', $id)->get();

        return view('/admin/firelogs', ['firelogs' => $firelogs]);
    }


}
