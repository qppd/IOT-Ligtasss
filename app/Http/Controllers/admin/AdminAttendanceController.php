<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Attendance;

class AdminAttendanceController extends Controller
{
    function fetchAttendance()
    {
        //SELECT `id`, `reference_id`, `room_id`, `date`, `time_in`, `time_out`, 
        //`status`, `created_at`, `updated_at` FROM `attendance` WHERE 1
        $attendances = Attendance::select(
            'attendances.id',
            'attendances.reference_id',
            DB::raw('CONCAT(users.surname, ", ", users.firstname) as student'),
            'attendances.room_id',
            'attendances.date',
            'attendances.time_in',
            'attendances.time_out',
            DB::raw('(CASE
                WHEN attendances.status = 0 THEN "Failed"
                WHEN attendances.status = 1 THEN "Passed"
                ELSE "Unknown" END) as status'),
            'attendances.created_at',
            'attendances.updated_at',
        )
            ->join('users', 'users.id', '=', 'attendances.reference_id')
            ->get();

        return view('admin/attendance', ['attendances' => $attendances]);
    }
}
