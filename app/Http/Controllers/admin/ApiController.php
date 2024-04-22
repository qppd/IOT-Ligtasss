<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function receiveData(Request $request)
    {
        // Handle the incoming data
        $data = $request->all();

        dd($data);
        // Process the data (you can store it in the database, perform actions, etc.)
        // For now, let's just return the received data
        return response()->json(['received_data' => $data]);
    }
}
