<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Gate;

class AdminGateController extends Controller
{
    function fetchGate()
    {

        //SELECT `id`, `face_id`, `body_temperature`, `metal_detection`, `status`, 
        //`created_at`, `updated_at` FROM `gates` WHERE 1

        $gates = Gate::select(
            'gates.id',
            DB::raw('CONCAT(users.surname, ", ", users.firstname) as staff'),
            'gates.face_id',
            'gates.body_temperature',
            DB::raw('(CASE
                WHEN gates.metal_detection = 0 THEN "None"
                WHEN gates.metal_detection = 1 THEN "Metal detected"
                ELSE "Unknown" END) as metal_detection'),
            DB::raw('(CASE
                WHEN gates.status = 0 THEN "Failed"
                WHEN gates.status = 1 THEN "Passed"
                ELSE "Unknown" END) as status'),
                'gates.created_at',
            'gates.created_at',
            'gates.updated_at',
        )
            ->join('users', 'users.user_id', '=', 'gates.face_id')
            ->get();


        // $reviewers = Reviewer::select(
        //     'reviewers.id',
        //     'reviewers.file',
        //     DB::raw('(CASE
        //         WHEN reviewers.status = 0 THEN "Pending"
        //         WHEN reviewers.status = 1 THEN "Approved"
        //         WHEN reviewers.status = 2 THEN "Rejected"
        //         ELSE "Unknown" END) as status'),
        //     DB::raw('CONCAT(users.surname, ", ", users.firstname) as professor'),
        //     'reviewers.created_at',
        //     'reviewers.updated_at',
        // )
        //     ->join('users', 'users.id', '=', 'reviewers.professor_id')
        //     ->where('reviewers.examination_id', '=', $examination_id)
        //     ->get();

        return view('admin/gate', ['gates' => $gates]);

    }
}
