<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class AdminDashboardController extends Controller
{

    protected $database;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    function fetchAdminDashboard()
    {
        $ref_table =  'contacts';
        
        // $reference = $this->database->getReference('files/devices/01');
        // $snapshot = $reference->getSnapshot();
        // $value = $snapshot->getValue();
        //dd($value);
        return view('admin/dashboard');
    }

    function fetchAdminDashboardData(){
        $reference = $this->database->getReference('datas/modules');
        $snapshot = $reference->getSnapshot();

        
        $value = $snapshot->getValue();

        return response()->json($value);
    }

    
}
